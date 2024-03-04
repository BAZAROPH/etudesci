<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =  [
        'label',
        'created_at',
        'updated_at',
    ];


    public function Users(){
        return $this->hasMany(User::class, 'role');
    }
}
