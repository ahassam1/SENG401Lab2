<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
    ];

    public function book() {
    	return $this->belongsTo(Book::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
