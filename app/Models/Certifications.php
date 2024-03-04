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

class Certifications extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'title',
        'slug',
        'office',
        'price',
        'office_money',
        'reduction',
        'premium_price',
        'start_date',
        'end_date',
        'location_type',
        'email',
        'website',
        'phone',
        'whatsapp',
        'description',
        'objective',
        'script',
        'personalized_script',
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

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'certifications_domaines', 'certification', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function restoreUrl(){
        return route('admin.certification.restore', $this->slug);
    }

    public function editUrl(){
        return route('admin.certification.edit', $this->slug);
    }

    public function carbonHumanDate(){
        return Carbon::parse($this -> created_at)->translatedFormat('d F Y');
    }

    public function carbonHumanBeginDate(){
        return Carbon::parse($this -> start_date)->translatedFormat('l d F Y');
    }

    public function carbonHumanBeginHour(){
        return Carbon::parse($this -> start_date)->translatedFormat('H\hi');
    }

    public function carbonHumanEndDate(){
        return Carbon::parse($this -> end_date)->translatedFormat('l d F Y');
    }

    public function carbonHumanEndHour(){
        return Carbon::parse($this -> end_date)->translatedFormat('H\hi');
    }

    public function detailsUrl(){
        return route('certification.details', $this->slug);
    }
}
