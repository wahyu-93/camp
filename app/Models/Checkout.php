<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['user', 'camp'];

    public function setExpiredAttribute($value)
    {
        // Y-m-d (awal tgl dalam bulan)
        // $this->attributes['expired'] = date('Y-m-d', strtotime($value));
        
        // Y-m-t (akhir tgl dalam bulan)
        $this->attributes['expired'] = date('Y-m-t', strtotime($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
