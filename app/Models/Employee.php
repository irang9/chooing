<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // employees 테이블과 연결
    protected $table = 'employees';

    // 대량 할당을 허용할 필드들
    protected $fillable = [
        'name',
        'phone',
        'company_phone',
        'email',
        'hire_date',
        'status',
    ];
    // 타임스탬프 사용 여부
    // public $timestamps = false;  // 타임스탬프를 사용하지 않을 경우


    // 재직 상태 상수 정의
    const STATUS = [
        '' => '선택',
        '1' => '재직',
        '2' => '외주',
        '3' => '퇴사',
        '4' => '기타',
    ];

    // Employee 모델에 추가
public static function getStatusLabel($status)
{
    $statusOptions = self::STATUS;  // 상수값 가져오기
    return isset($statusOptions[$status]) ? $statusOptions[$status] : '-';  // 상태에 맞는 텍스트 반환
}
    // // 상태값을 상수로 정의
    // const STATUS_ACTIVE = 1;
    // const STATUS_EXTERNAL = 2;
    // const STATUS_TERMINATED = 3;
    // const STATUS_OTHER = 4;

    // // 상태 값을 human-readable 형식으로 반환
    // public static function getStatusOptions()
    // {
    //     return [
    //         self::STATUS_ACTIVE => '재직',
    //         self::STATUS_EXTERNAL => '외주',
    //         self::STATUS_TERMINATED => '퇴사',
    //         self::STATUS_OTHER => '기타',
    //     ];
    // }
}