<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'contact',
        'password',
        'token',
        'flag',
        'email_verify_token',
        'email_verified_at',
        'role',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Role(){
        return $this->belongsTo(Roles::class, 'role');
    }

    public function Resumes(){
        return $this->hasMany(Resume::class, 'user');
    }

    public function Courses(){
        return $this->belongsToMany(Courses::class, 'users_courses', 'user', 'course')->withTimestamps()->withPivot('id', 'course');
    }

    public function Modules(){
        return $this->belongsToMany(Modules::class, 'users_modules', 'user', 'module')->withTimestamps()->withPivot('id', 'module');
    }

    public function restoreUrl(){
        return route('admin.user.restore', $this->id);
    }

    public function Subscription(){
        return $this->hasOne(Subscriptions::class, 'user');
    }

    public function Tests(){
        return $this->hasMany(Tests::class, 'user');
    }
}
