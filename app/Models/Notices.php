<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notices extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'comment',
        'note',
        'user',
        'course',
        'created_at',
        'updated_at',
    ];

    public function Course(){
        return $this->belongsTo(Courses::class, 'course');
    }
}
