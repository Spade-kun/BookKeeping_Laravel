<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the users that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the team leads.
     */
    public function leads()
    {
        return $this->belongsToMany(User::class)
            ->wherePivot('role', 'lead')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the team members (excluding leads).
     */
    public function members()
    {
        return $this->belongsToMany(User::class)
            ->wherePivot('role', 'member')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the threads assigned to this team.
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Get all users who have threads with this team.
     */
    public function assignedUsers()
    {
        return User::whereHas('thread', function ($query) {
            $query->where('team_id', $this->id);
        });
    }
}
