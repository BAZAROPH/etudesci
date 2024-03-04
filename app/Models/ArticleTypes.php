<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleTypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'label',
        'created_at',
        'updated_at',
    ];

    public function Articles(){
        return $this->hasMany(Articles::class, 'type');
    }
}
