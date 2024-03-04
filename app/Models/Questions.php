<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'response_1',
        'response_2',
        'response_3',
        'course',
        'response',
        'created_at',
        'updated_at',
    ];

    public function Course(){
        return $this->belongsTo(Courses::class, 'course');
    }
}
