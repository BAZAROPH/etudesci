<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Authors extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'last_name',
        'first_name',
        'slug',
        'company',
        'function',
        'type',
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

    public function Type(){
        return $this->belongsTo(AuthorTypes::class, 'type');
    }

    public function Articles(){
        return $this->belongsToMany(Articles::class, 'authors_articles', 'author', 'article')->withTimestamps()->withPivot('id', 'article');
    }

    public function Books(){
        return $this->belongsToMany(Books::class, 'authors_books', 'author', 'book')->withTimestamps()->withPivot('id', 'book');
    }

    public function editUrl(){
        return route('admin.author.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.author.restore', $this->slug);
    }
}
