<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domaines extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'label',
        'type',
        'created_at',
        'updated_at',
    ];

    public function Type(){
        return $this->belongsTo(DomaineTypes::class, 'type');
    }

    public function Books(){
        return $this->belongsToMany(Books::class, 'books_domaines', 'domaine', 'book')->withTimestamps()->withPivot('id', 'book');
    }

    public function Articles(){
        return $this->belongsToMany(Articles::class, 'articles_domaines', 'domaine', 'article')->withTimestamps()->withPivot('id', 'article');
    }

    public function Events(){
        return $this->belongsToMany(Events::class, 'events_domaines', 'domaine', 'event')->withTimestamps()->withPivot('id', 'event');
    }

    public function Certifications(){
        return $this->belongsToMany(Certifications::class, 'certifications_domaines', 'domaine', 'certification')->withTimestamps()->withPivot('id', 'certification');
    }

    public function Offices(){
        return $this->belongsToMany(offices::class, 'offices_domaines', 'domaine', 'article')->withTimestamps()->withPivot('id', 'article');
    }

    public function Courses(){
        return $this->belongsToMany(Courses::class, 'courses_domaines', 'domaine', 'course')->withTimestamps()->withPivot('id', 'course');
    }

    public function restoreUrl(){
        return route('admin.domaine.restore', $this->id);
    }
}
