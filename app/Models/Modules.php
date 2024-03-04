<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modules extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'title',
        'slug',
        'youtube',
        'duration',
        'description',
        'course',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ],
        ];
    }

    public function Course(){
        return $this->belongsTo(Courses::class, 'course');
    }

    public function Users(){
        return $this->belongsToMany(User::class, 'users_modules', 'module', 'user')->withTimestamps()->withPivot('id', 'user', 'state');
    }
}
