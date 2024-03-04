<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'course',
        'score',
        'passed_at',
        'created_at',
        'update_at',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user');
    }

    public function Course(){
        return $this->belongsTo(Courses::class, 'course');
    }
}
