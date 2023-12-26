<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory, Sortable;

    const AKTIF = 1;
    const TAMAT = 0;

    
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


    // sorting
    public $sortable = [
        'id',
        'name',
        'nis',
        'class',
        'gender',
        'address',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'created_by',
        'updated_by',
        'name',
        'nis',
        'class',
        'gender',
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
        'gender'  => 'string',
        'address' => 'string',
        'major_id'   => 'string',
        'status'  => 'integer',
    ];

    // relasi dari table majors
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    // relasi dari table payments
    public function payment()
    {
        return $this->hasMany(Payment::class);
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
