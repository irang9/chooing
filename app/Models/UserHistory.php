<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    // 테이블 이름 지정
    protected $table = 'user_histories';

    protected $fillable = [
        'user_id', 'type', 'field', 'old_value', 'new_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
