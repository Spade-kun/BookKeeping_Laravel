<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is team member
     */
    public function isTeam(): bool
    {
        return $this->role === 'team';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get the documents for the user.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the reports for the user.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get the transactions for the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the user's subscription.
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active');
    }

    /**
     * Get the user's active subscription (alias for subscription).
     */
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active');
    }

    /**
     * Get all subscriptions for the user.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Check if user has an active subscription.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscription()->exists();
    }

    /**
     * Check if user has a password set.
     * Google OAuth users may not have a password.
     */
    public function hasPassword(): bool
    {
        return !empty($this->password);
    }

    /**
     * Get the team that the user belongs to.
     */
    public function team()
    {
        return $this->belongsToMany(Team::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the user's primary team (if any).
     */
    public function primaryTeam()
    {
        return $this->team()->first();
    }

    /**
     * Check if user is a team lead.
     */
    public function isTeamLead(): bool
    {
        $team = $this->team()->first();
        return $team && $team->pivot->role === 'lead';
    }

    /**
     * Get the user's support thread.
     */
    public function thread()
    {
        return $this->hasOne(Thread::class);
    }

    /**
     * Get messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
