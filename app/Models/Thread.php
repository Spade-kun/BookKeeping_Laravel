<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'team_id',
        'status',
        'last_message_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the thread.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the team assigned to the thread.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the messages for the thread.
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get the latest message.
     */
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    /**
     * Scope a query to only include open threads.
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope a query to only include closed threads.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Close the thread.
     */
    public function close()
    {
        $this->update(['status' => 'closed']);
    }

    /**
     * Reopen the thread.
     */
    public function reopen()
    {
        $this->update(['status' => 'open']);
    }

    /**
     * Check if thread is open.
     */
    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    /**
     * Check if thread is closed.
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }
}
