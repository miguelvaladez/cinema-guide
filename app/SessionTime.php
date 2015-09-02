<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionTime extends Model
{
    protected $table = 'session_times';
    protected $fillable = ['movie_id', 'cinema_id', 'session_time'];
    public $timestamps = false;

    public function movie()
    {
    	return $this->hasOne('App\Movie');
    }

    public function cinema()
    {
    	return $this->belongsTo('App\Cinema');
    }
}
