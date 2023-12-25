<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $fillable = 
    [ 
        'name',
        'teacher_id',
        'olympiad_entry_id',
        'citizenship_id',
        'ovz',
        'status',
        'created_at',
        'updated_at',
    ];
}
