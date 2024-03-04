<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainers extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Sluggable, SluggableScopeHelpers;
    protected $fillable = [
        'last_name',
        'first_name',
        'slug',
        'campany',
        'email',
        'function',
        'contact',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'description',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'first_name'
            ],
        ];
    }


    public function Courses(){
        return $this->hasMany(Courses::class, 'trainer');
    }

    public function Trainer(){
        return $this->hasMany(OnlineClass::class, 'trainer');
    }

    public function editUrl(){
        return route('admin.trainer.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.trainer.restore', $this->slug);
    }


}
