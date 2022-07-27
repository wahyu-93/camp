<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getIsRegisteredAttribute()
    {
        if(!Auth::check()){
            return false;
        };
     
        $data = Checkout::whereUserId(Auth::id())->whereCampId($this->id)->exists();

        return $data; 
    }

    public function campBenefits()
    {
        return $this->hasMany(campBenefits::class);
    }
}
