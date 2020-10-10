<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['ip', 'os', 'browser', 'device', 'country_name', 'region_name', 'city_name', 'zip_code', 'latitude', 'longitude'];
}
