<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	public function user() {
		return $this->belongsTo(User::class);
	}

    public function playlist() {
    	return $this->belongsTo(Playlist::class);
    }
}