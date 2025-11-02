<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmailSubscription extends Model
{
    protected $fillable = [
        'email',
        'status',
        'token',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Generate unique token for unsubscribe
     */
    public static function generateToken(): string
    {
        do {
            $token = Str::random(64);
        } while (self::where('token', $token)->exists());

        return $token;
    }

    /**
     * Subscribe an email
     */
    public static function subscribe(string $email): self
    {
        $subscription = self::where('email', $email)->first();

        if ($subscription) {
            // If already exists and unsubscribed, resubscribe
            if ($subscription->status === 'unsubscribed') {
                $subscription->status = 'subscribed';
                $subscription->subscribed_at = now();
                $subscription->unsubscribed_at = null;
                $subscription->token = self::generateToken();
                $subscription->save();
            }
            return $subscription;
        }

        // Create new subscription
        return self::create([
            'email' => strtolower($email),
            'status' => 'subscribed',
            'token' => self::generateToken(),
            'subscribed_at' => now(),
        ]);
    }

    /**
     * Unsubscribe using token
     */
    public function unsubscribe(): bool
    {
        $this->status = 'unsubscribed';
        $this->unsubscribed_at = now();
        return $this->save();
    }
}
