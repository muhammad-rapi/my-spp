<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

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
        'month' => 'integer'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'major_id', 'id');
    }
}
