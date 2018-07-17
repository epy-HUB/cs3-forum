<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class About extends Model
{
    protected $fillable = [
        'eduction', 'location', 'bio',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
