<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'cat_id', 'name', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'cat_id');
    }
}
