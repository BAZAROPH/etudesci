<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'title',
        'slug',
        'youtube',
        'office',
        'trainer',
        'description',
        'published',
        'type',
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

    public function Office(){
        return $this->belongsTo(Offices::class, 'office');
    }

    public function Modules(){
        return $this->HasMany(Modules::class, 'course');
    }

    public function Notices(){
        return $this->hasMany(Notices::class, 'course');
    }

    public function Trainer(){
        return $this->belongsTo(Trainers::class, 'trainer');
    }

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'courses_domaines', 'course', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function Users(){
        return $this->belongsToMany(User::class, 'users_courses', 'course', 'user')->withTimestamps()->withPivot('id', 'user');
    }

    public function Questions(){
        return $this->hasMany(Questions::class, 'course');
    }

    public function Tests(){
        return $this->HasMany(Tests::class, 'test');
    }

    public function editUrl(){
        return route('admin.course.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.course.restore', $this->slug);
    }

    public function publishedUrl(){
        return route('admin.course.published', $this->slug);
    }

    public function moduleUrl(){
        return route('admin.module.index', $this->slug);
    }

    public function carbonHumanDate(){
        return Carbon::parse($this -> created_at)->translatedFormat('d F Y');
    }

    public function detailsUrl(){
        return route('course.details', $this->slug);
    }
}
