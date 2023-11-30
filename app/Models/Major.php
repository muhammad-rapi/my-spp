<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;


class Major extends Model
{
    use HasFactory, Sortable;

    protected $table = 'majors';


    // menambahkan event jika data berhasil dibuat maka data created_by atau updated_by bisa diisi
    protected static function booted()
    {
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

    // sortable
    public $sortable = [
        'id', 
        'name', 
        'category',
        'created_by',
        'updated_by',
        'created_at', 
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'created_by',
        'updated_by',
        'deleted_by',
        'name',
        'category',
    ];

    protected $casts = [
        'id'      => 'string',
        'created_by' => 'string',
        'updated_by' => 'string',
        'deleted_by' => 'string',
        'name' => 'string',
        'category' => 'string'
    ];

    // relasi dari table student
    public function students()
    {
        return $this->hasMany(Student::class, 'major', 'id');
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
