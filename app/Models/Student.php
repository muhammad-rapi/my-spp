<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // menambahkan event jika data berhasil dibuat maka data created_by atau updated_by bisa diisi
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
        'id',
        'created_by',
        'updated_by',
        'name',
        'nis',
        'class',
        'address',
        'major_id',
        'status'
    ];

    protected $casts = [
        'id'      => 'string',
        'created_by' => 'string',
        'updated_by' => 'string',
        'nis'     => 'string',
        'class'   => 'string',
        'address' => 'string',
        'major_id'   => 'string',
        'status'  => 'boolean',
    ];

    // relasi dari table majors
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    // relasi dari table payments
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // menambahkan created_by
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // menambahkan udpated_by
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }



}
