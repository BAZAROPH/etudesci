<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'references',
        'invoice',
        'user',
        'amount',
        'pay_at',
        'token',
        'state',
        'product_type',
        'product_id',
        'updated_at',
        'created_at',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user');
    }

    public function Date(){
        return Carbon::parse($this->pay_at)->format('d/m/Y à H\hi');
    }
}
