<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $table = 'cinemas';
    protected $fillable = ['name', 'address', 'latitude', 'longitude'];
    public $timestamps = false;

    public function sessionTimes()
    {
    	return $this->hasMany('App\SessionTime', 'cinema_id');
    }
}
