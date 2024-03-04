<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizers extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Sluggable, SluggableScopeHelpers;
    protected $fillable = [
        'name',
        'slug',
        'contact',
        'description',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    public function Events(){
        return $this->hasMany(Events::class, 'organizer');
    }

    public function editUrl(){
        return route('admin.organizer.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.organizer.restore', $this->slug);
    }
}
