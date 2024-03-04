<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accreditassions extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'acronym',
        'label',
        'created_at',
        'updated_at',
    ];

    public function Offices(){
        return $this->belongsToMany(Offices::class, 'offices_accreditassions', 'accreditassion', 'office')->withTimestamps()->withPivot('id', 'office');
    }

    public function editUrl(){
        return route('admin.accreditassion.edit', $this->id);
    }

    public function restoreUrl(){
        return route('admin.accreditassion.restore', $this->id);
    }
}
