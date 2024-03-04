<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthorTypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'label',
        'created_at',
        'updated_at',
    ];

    public function Authors(){
        return $this->hasMany(Authors::class, 'type');
    }
}
