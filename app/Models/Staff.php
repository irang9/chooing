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
        'memo', // 메모 필드 추가
        'position', // 직함 필드 추가
        'birthday', // 생일 필드 추가
        'start_time', // 출근 시간 필드 추가
        'end_time', // 퇴근 시간 필드 추가
        'work_days' // 주 근무시간 필드 추가
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
