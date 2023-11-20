<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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

    protected $table = 'payments';
    protected $fillable = [
        'id',
        'student_id',
        'amount_payment',
        'month',
    ];

    protected $casts = [
        'id' => 'string',
        'student_id' => 'string',
        'amount_payment' => 'integer',
        'month' => 'string'
    ];

    // relasi dari table student
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }   

    // menambahkan created_by
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // menambahkan updated_by
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
