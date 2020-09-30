<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutlateController extends Controller
{
    //All
    public function All()
    {
        return view('user.outlate.all');
    }

    //SubArea
    public function SubArea($name)
    {

        // if ($name == 'dh-1') {

        //     $name = 'Zone-1';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.76136, 90.40273"
        //     ></iframe>';
        // } elseif ($name == 'dh-2') {

        //     $name = 'Zone-2';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.75317, 90.4298"
        //     ></iframe>';
        // } elseif ($name == 'dh-3') {

        //     $name = 'Zone-3';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.72262, 90.41941"
        //     ></iframe>';
        // } elseif ($name == 'dh-4') {

        //     $name = 'Zone-4';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.74745, 90.37598"
        //     ></iframe>';
        // } elseif ($name == 'dh-5') {

        //     $name = 'Zone-5';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.79308, 90.36817"
        //     ></iframe>';
        // } elseif ($name == 'ctg') {

        //     $name = 'Chittagong';

        //     $gmap = '<iframe
        //     src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=22.35306, 91.82939"
        //     ></iframe>';
        // }


        if ($name == 'dhk') {

            $name = 'Dhaka';
            $gmap = '<iframe
            src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.76136, 90.40273"
            ></iframe>';
        } elseif ($name == 'ctg') {
            $name = 'Chittagong';
            $gmap = '<iframe
            src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=22.35306, 91.82939"
            ></iframe>';
        } else {
            $name = 'All';
            $gmap = '<iframe
            src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.76136, 90.40273"
            ></iframe>';
        }


        return view('user.outlate.sub-area', compact('gmap', 'name'));
    }
}
