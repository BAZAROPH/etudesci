<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriptions extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'references',
        'user',
        'amount',
        'pay_at',
        'token',
        'state',
        'start',
        'end',
        'updated_at',
        'created_at',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user');
    }

    public function endDate(){
        return Carbon::parse($this->end)->format('d/m/Y');
    }
    public function endHour(){
        return Carbon::parse($this->end)->translatedFormat('H\hi');
    }

    public function startDate(){
        return Carbon::parse($this->start)->format('d/m/Y');
    }
    public function startHour(){
        return Carbon::parse($this->start)->translatedFormat('H\hi');
    }
}
