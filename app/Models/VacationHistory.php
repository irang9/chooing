<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacation_id', 'field', 'old_value', 'new_value'
    ];

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
    }
}
