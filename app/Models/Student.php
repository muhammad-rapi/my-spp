<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = \Auth::id();
            $model->updated_by = \Auth::id();
        });

        static::saving(function ($model) {
            $model->updated_by = \Auth::id();
        });
    }

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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }



}
