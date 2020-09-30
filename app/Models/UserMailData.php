<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMailData extends Model
{
    protected $fillable = ['name', 'contact', 'email', 'details'];

}
