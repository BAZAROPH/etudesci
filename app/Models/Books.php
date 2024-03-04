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

class Books extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'title',
        'slug',
        'author',
        'price',
        'reduction',
        'premium_price',
        'script',
        'description',
        'published',
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

    public function Authors(){
        return $this->belongsToMany(Authors::class, 'authors_books', 'book', 'author')->withTimestamps()->withPivot('id', 'author');
    }

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'books_domaines', 'book', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function restoreUrl(){
        return route('admin.book.restore', $this->slug);
    }

    public function editUrl(){
        return route('admin.book.edit', $this->slug);
    }

    public function publishedUrl(){
        return route('admin.book.published', $this->slug);
    }

    public function carbonHumanDate(){
        return Carbon::parse($this -> created_at)->translatedFormat('d F Y');
    }

    public function detailsUrl(){
        return route('book.details', $this->slug);
    }
}
