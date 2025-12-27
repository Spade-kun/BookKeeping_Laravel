<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'thread_id',
        'sender_id',
        'sender_role',
        'message',
        'attachment_path',
    ];

    /**
     * Get the thread that owns the message.
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Check if message is from user.
     */
    public function isFromUser(): bool
    {
        return $this->sender_role === 'user';
    }

    /**
     * Check if message is from team.
     */
    public function isFromTeam(): bool
    {
        return $this->sender_role === 'team';
    }

    /**
     * Check if message is from admin.
     */
    public function isFromAdmin(): bool
    {
        return $this->sender_role === 'admin';
    }

    /**
     * Update thread's last message timestamp when message is created.
     */
    protected static function booted()
    {
        static::created(function ($message) {
            $message->thread->update([
                'last_message_at' => $message->created_at,
            ]);
        });
    }
}
