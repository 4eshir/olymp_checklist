<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    protected $fillable = 
    [ 
        'name',
        'teacher_id',
        'olympiad_entry_id',
        'citizenship_id',
        'ovz',
        'status',
        'save_at',
    ];
}
