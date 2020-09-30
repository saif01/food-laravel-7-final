<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
