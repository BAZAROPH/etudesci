<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offices extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'slug',
        'name',
        'email',
        'address',
        'phone',
        'website',
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
                'source' => 'name'
            ],
        ];
    }

    public function Certifications(){
        return $this->hasMany(Certifications::class, 'office');
    }

    public function Courses(){
        return $this->hasMany(Courses::class, 'office');
    }

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'offices_domaines', 'office', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function Accreditassions(){
        return $this->belongsToMany(Accreditassions::class, 'offices_accreditassions', 'office', 'accreditassion')->withTimestamps()->withPivot('id', 'accreditassion');
    }

    public function editUrl(){
        return route('admin.office.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.office.restore', $this->slug);
    }

    public function detailsUrl(){
        return route('office.details', $this->slug);
    }

}
