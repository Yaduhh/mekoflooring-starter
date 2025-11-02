<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('deleted_status', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:subscriptions,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('subscription_error', $validator->errors()->first('email'));
        }

        try {
            Subscription::create([
                'email' => strtolower($request->email),
                'status' => 'subscribed',
                'deleted_status' => false,
            ]);

            return back()->with('subscription_success', 'Terima kasih! Email Anda berhasil didaftarkan untuk newsletter kami.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('subscription_error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }
}
