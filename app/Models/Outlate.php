<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Outlate extends Model
{
    protected $fillable = ['division', 'district','local_area', 'shop_name', 'address', 'contact', 'status', 'published_by', 'created_by'];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
