<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id', 'type', 'field', 'old_value', 'new_value'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
