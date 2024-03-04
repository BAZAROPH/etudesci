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

class Events extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    protected $fillable = [
        'name',
        'slug',
        'organizer',
        'type',
        'price',
        'reduction',
        'premium_price',
        'office_money',
        'start_date',
        'end_date',
        'email',
        'place_type',
        'place',
        'personalized_link',
        'registration_link',
        'phone',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'published',
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

    public function Type(){
        return $this->belongsTo(EventTypes::class, 'type');
    }

    public function Organizer(){
        return $this->belongsTo(Organizers::class, 'organizer');
    }

    public function Domaines(){
        return $this->belongsToMany(Domaines::class, 'events_domaines', 'event', 'domaine')->withTimestamps()->withPivot('id', 'domaine');
    }

    public function editUrl(){
        return route('admin.event.edit', $this->slug);
    }

    public function restoreUrl(){
        return route('admin.event.restore', $this->slug);
    }

    public function publishedUrl(){
        return route('admin.event.published', $this->slug);
    }

    public function carbonHumanDate(){
        return Carbon::parse($this->start_date)->translatedFormat('d F Y');
    }

    public function carbonHumanHour(){
        return Carbon::parse($this->start_date)->translatedFormat('H\hi');
    }

    public function carbonHumanEndDate(){
        return Carbon::parse($this->end_date)->translatedFormat('d F Y');
    }

    public function carbonHumanEndHour(){
        return Carbon::parse($this->end_date)->translatedFormat('H\hi');
    }

    public function AgendaDate(){
        $start = Carbon::parse($this->start);
        $start = $start->format('Ymd').'T'.$start->format('His').'Z';
        $end = Carbon::parse($this->end);
        $end = $end->format('Ymd').'T'.$end->format('His').'Z';
        return "$start/$end";
    }

    public function detailsUrl(){
        return route('event.details', $this->slug);
    }
}
