<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class PaymentHistoryLog extends Model
{
    use HasFactory;


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


    protected $table = 'payment_history_logs';
    protected $fillable = [
        'id',
        'payment_id',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id'             => 'string',
        'payment_id'     => 'string',
        'created_by'     => 'string',
        'updated_by'     => 'string',
    ];

    // relasi dari table student
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
