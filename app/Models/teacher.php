<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'school',
        'position',
        'url_id'
    ];
}
