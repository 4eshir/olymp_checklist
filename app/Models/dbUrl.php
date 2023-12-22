<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dbUrl extends Model
{
    use HasFactory;
    protected $table = 'url';

    public $timestamps = false;

    protected $fillable = [
        'raw',
        'municipality_id',
        'school_id',
        'state',
    ];
}
