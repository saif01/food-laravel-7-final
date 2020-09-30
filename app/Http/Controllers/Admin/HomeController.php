<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Product;
use App\Models\Outlate;
use App\Models\Promotion;



class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //Admin Dashboard
    public function Dashboard()
    {

        $totalPost = Post::count();
        $totalProduct = Product::count();
        $totalOutlate = Outlate::count();
        $totalPromotion = Promotion::count();

        return view('admin.food.index', \compact('totalPost', 'totalProduct', 'totalOutlate', 'totalPromotion'));
    }
}
