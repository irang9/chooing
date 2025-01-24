<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateStaffToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // staff 테이블의 데이터를 가져오기
        $staffRecords = DB::table('staff')->get();

        foreach ($staffRecords as $staff) {
            // 퇴사 상태는 건너뛰기
            // if ($staff->status === '퇴사') {
            //     continue;
            // }

            // 기본 이메일 설정
            $email = $staff->email ?? 'no-email-' . $staff->id . '@example.com';

            // 중복 이메일 건너뛰기
            $exists = DB::table('users')->where('email', $email)->exists();

            if (!$exists) {
                DB::table('users')->insert([
                    'name' => $staff->name, // 이름
                    'email' => $email, // 기본 이메일 또는 실제 이메일
                    'phone_number' => $staff->phone ?? 'N/A', // 휴대전화
                    'department' => $staff->position ?? '직급 미지정', // 직급
                    'company_phone' => $staff->company_phone ?? null, // 회사 전화번호
                    'extension' => $staff->extension ?? null, // 내선 번호
                    'birthday' => $staff->birthday ?? null, // 생일
                    'hire_date' => $staff->hire_date ?? null, // 입사일
                    'start_time' => $staff->start_time ?? null, // 근무 시작 시간
                    'end_time' => $staff->end_time ?? null, // 근무 종료 시간
                    'work_days' => $staff->work_days ?? null, // 근무일
                    'memo' => $staff->memo ?? null, // 메모
                    'created_at' => $staff->created_at, // 생성일
                    'updated_at' => $staff->updated_at, // 수정일
                    'password' => bcrypt('default_password'), // 기본 비밀번호 설정
                    'remember_token' => null, // null 값
                    'email_verified_at' => null, // 이메일 인증 초기화
                ]);
            }
        }
    }
}