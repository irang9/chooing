<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'start_date', 'end_date', 'status', 'memo'
    ];

    public function histories()
    {
        return $this->hasMany(VacationHistory::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
