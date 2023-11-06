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
        'major_id',
        'status'
    ];

    protected $casts = [
        'id'      => 'string',
        'nis'     => 'string',
        'class'   => 'string',
        'address' => 'string',
        'major_id'   => 'string',
        'status'  => 'boolean',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

}
