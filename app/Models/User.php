<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    const ADMIN_ROLE = 'admin';
    const OPERATOR_ROLE = 'operator';
    const HEADMASTER_ROLE = 'headmaster';

    protected static function booted() {
        static::creating(function ($model) {
            if( !$model->getKey() ) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
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

    public function hasRole($role_name) {
        return $this->role == $role_name;
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $sortable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
