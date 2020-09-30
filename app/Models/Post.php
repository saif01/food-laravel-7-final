<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Post extends Model
{
    protected $fillable = ['title', 'image', 'image_small', 'details', 'status', 'published_by', 'created_by' ];


    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
