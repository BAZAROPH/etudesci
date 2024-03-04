<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineClass extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'title',
        'slug',
        'trainer',
        'description',
        'date',
        'hour',
        'script',
        'type',
        'code',
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

    public function Trainer(){
        return $this->belongsTo(Trainers::class, 'trainer');
    }


    public function editUrl($slug){
        return route('admin.onlineClass.edit', $slug);
    }

    public function restoreUrl($slug){
        return route('admin.onlineClass.restore', $slug);
    }
}
