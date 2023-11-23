<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Arrear extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'arrears';

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

    // sortable
    public $sortable = [
        'id',
        'student_id',
        'payment_id',
        'month',
        'amount_of_arrears',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'student_id',
        'payment_id',
        'month',
        'amount_of_arrears',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id'         => 'string',
        'student_id'         => 'string',
        'payment_id'         => 'string',
        'created_by' => 'string',
        'updated_by' => 'string',
        'month'       => 'string',
        'amount_of_arrears'   => 'integer'
    ];

    // relasi dari table students
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // relasi dari table payments
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
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
