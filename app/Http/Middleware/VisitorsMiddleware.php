<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Middleware\Request;
use Location;
use App\Models\Visitor;
use App\Http\Controllers\UserDeviceInfo;
use Session;
use Illuminate\Support\Facades\Cache;

class VisitorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $ip     = $request->ip();
      //$ip   = '103.99.251.174';

      $ses_id = 'visitor'.$ip ;
      $request->session()->regenerate();
     
      $key_id = 'visitor'.$ip;

      // if (Cache::has($key_id)) {
      //   echo 'Old IP'. Cache::get($key_id);
      // }else{
      //   echo 'New IP '. $ip;
      //   Cache::put($key_id, $ip, now()->addMinutes(1));
      // }
      // die();

      $data = new Visitor();

      $userDevice       = new UserDeviceInfo();
      $data->ip         = $ip;
      $data->os         = $userDevice->get_os();
      $data->browser    = $userDevice->get_browser();
      $data->device     = $userDevice->get_device(); 

      //$user_ip_details = $userDevice->user_ip_details('103.99.251.174');

      $ip_data        = Location::get($ip);
      if($ip_data){
        $data->country_name  = $ip_data->countryName;
        $data->region_name   = $ip_data->regionName;
        $data->city_name     = $ip_data->cityName;
        $data->zip_code      = $ip_data->zipCode;
        $data->latitude     = $ip_data->latitude;
        $data->longitude    = $ip_data->longitude;
      }
      $data->save();

      //dd( $os, $browser, $device);

      return $next($request);

    }
}
