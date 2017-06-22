<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'date',
        'description',
        'url'
    ];

    protected $dates = [
        'date',
	    'created_at',
	    'updated_at',
    ];
}