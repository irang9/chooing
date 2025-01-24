<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',          // Staff에서 가져온 필드
        'company_phone',  // Staff에서 가져온 필드
        'extension',      // Staff에서 가져온 필드
        'hire_date',      // Staff에서 가져온 필드
        'status',         // Staff에서 가져온 필드
        'memo',           // Staff에서 가져온 필드
        'position',       // Staff에서 가져온 필드
        'birthday',       // Staff에서 가져온 필드
        'start_time',     // Staff에서 가져온 필드
        'end_time',       // Staff에서 가져온 필드
        'work_days',      // Staff에서 가져온 필드
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'hire_date' => 'date',  // Staff에서 가져온 필드
        'birthday' => 'date',  // Staff에서 가져온 필드
        'start_time' => 'datetime', // Staff에서 가져온 필드
        'end_time' => 'datetime', // Staff에서 가져온 필드
        'work_days' => 'float',  // Staff에서 가져온 필드
    ];

    /**
     * Relationships
     */

    // Staff의 관계를 통합
    public function editHistories()
    {
        return $this->hasMany(EditHistory::class);
    }

    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }
}