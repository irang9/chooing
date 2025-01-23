<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'company_phone',
        'extension',
        'email',
        'hire_date',
        'status',
        'memo' // 메모 필드 추가
    ];

    public function editHistory()
    {
        return $this->hasMany(EditHistory::class);
    }
    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }
}
