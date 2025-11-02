<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailSubscriptionRequest;
use App\Models\EmailSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailSubscriptionController extends Controller
{
    /**
     * Store a new email subscription
     */
    public function store(StoreEmailSubscriptionRequest $request): JsonResponse
    {
        try {
            $email = strtolower($request->validated()['email']);
            
            // Check if email already subscribed
            $existing = EmailSubscription::where('email', $email)
                ->where('status', 'subscribed')
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email ini sudah terdaftar untuk newsletter.',
                ], 422);
            }

            // Subscribe email
            $subscription = EmailSubscription::subscribe($email);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Email Anda berhasil terdaftar untuk newsletter.',
                'data' => [
                    'email' => $subscription->email,
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi nanti.',
            ], 500);
        }
    }

    /**
     * Unsubscribe email using token
     */
    public function unsubscribe(Request $request, string $token): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $subscription = EmailSubscription::where('token', $token)->first();

        if (!$subscription) {
            return redirect()->route('home')
                ->with('error', 'Token tidak valid atau sudah kedaluwarsa.');
        }

        if ($subscription->status === 'unsubscribed') {
            return view('newsletter.unsubscribed', [
                'message' => 'Email Anda sudah berhenti berlangganan sebelumnya.',
            ]);
        }

        $subscription->unsubscribe();

        return view('newsletter.unsubscribed', [
            'message' => 'Email Anda berhasil berhenti berlangganan newsletter.',
        ]);
    }

    /**
     * Display a listing of email subscriptions (Admin)
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $query = EmailSubscription::query();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by email
        if ($request->has('search') && $request->search) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $subscriptions = $query->paginate(20);
        
        $totalSubscribed = EmailSubscription::where('status', 'subscribed')->count();
        $totalUnsubscribed = EmailSubscription::where('status', 'unsubscribed')->count();
        $totalAll = EmailSubscription::count();

        return view('admin.newsletter.index', compact('subscriptions', 'totalSubscribed', 'totalUnsubscribed', 'totalAll'));
    }
}
