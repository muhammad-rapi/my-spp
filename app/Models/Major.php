<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'majors';

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

    public function students()
    {
        return $this->hasMany(Student::class, 'major_id', 'id');
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
