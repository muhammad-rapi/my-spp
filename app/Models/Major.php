<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'majors';
    protected $fillable = ['name','category'];

    protected $casts = [
        'id'      => 'string',
        'name' => 'string',
        'category' => 'string'
    ];


}
