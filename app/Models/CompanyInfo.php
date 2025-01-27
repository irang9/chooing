<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'company_name',
        'company_biz_reg_number',
        'company_ceo_name',
        'company_address',
        'company_phone',
        'company_email',
        'complaint_email',
        'publishing_brand',
        'publishing_phone',
        'publishing_email',
        'office_building',
        'office_management',
        'office_fire_safety',
        'office_communication',
    ];
}