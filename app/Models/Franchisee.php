<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franchisee extends Model
{
    protected $fillable = ['name', 'age', 'occupation', 'gender', 'contact', 'address', 'email', 'location'];
}
