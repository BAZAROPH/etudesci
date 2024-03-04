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

class Articles extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'type',
        'text',
        'published',
        'vertical_slide',
        'horizontal_slide',
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

    public function Type(){
        return $this->belongsTo(ArticleTypes::class, 'type');
    }

    public function Authors(){
        return $this->belongsToMany(Authors::class, 'authors_articles', 'article', 'author')->withTimestamps()->withPivot('id', 'author');
    }

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'articles_domaines', 'article', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function editUrl(){
        return route('admin.article.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.article.restore', $this->slug);
    }

    public function publishedUrl(){
        return route('admin.article.published', $this->slug);
    }

    public function leftSlide(){
        return route('admin.article.leftSlide', $this->slug);
    }

    public function rightSlide(){
        return route('admin.article.rightSlide', $this->slug);
    }

    public function carbonHumanDate(){
        return Carbon::parse($this -> created_at)->translatedFormat('d F Y');
    }

    public function detailsUrl(){
        return route('article.details', $this->slug);
    }

}
