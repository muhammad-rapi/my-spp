<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;


class Payment extends Model {
    use HasFactory, Sortable;

    // jenis status pembayaran
    const PAID = 'paid';
    const UNPAID = 'unpaid';

    // menambahkan event jika data berhasil dibuat maka data created_by atau updated_by bisa diisi
    protected static function booted() {
        static::creating(function ($model) {
            if( !$model->getKey() ) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
            $model->created_by = \Auth::id();
            $model->updated_by = \Auth::id();
        });

        static::saving(function ($model) {
            $model->updated_by = \Auth::id();
        });
    }

    public function getIncrementing() {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType() {
        return 'string';
    }

    public $sortable = [
        'id',
        'student_id',
        'amount_payment',
        'month',
        'year',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $table = 'payments';
    protected $fillable = [
        'id',
        'student_id',
        'amount_payment',
        'month',
        'year',
        'status',
    ];

    protected $casts = [
        'id'             => 'string',
        'student_id'     => 'string',
        'amount_payment' => 'integer',
        'month'          => 'string',
        'year'           => 'string',
        'status'         => 'string'
    ];


    // relasi dari table student
    public function students() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // menambahkan created_by
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    // menambahkan updated_by
    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
