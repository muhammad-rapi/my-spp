<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'nis',
        'class',
        'address',
        'major',
        'status'
    ];

    protected $casts = [
        'id'      => 'string',
        'nis'     => 'string',
        'class'   => 'string',
        'address' => 'string',
        'major'   => 'string',
        'status'  => 'boolean',
    ];


}
