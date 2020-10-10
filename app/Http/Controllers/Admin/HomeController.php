<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Product;
use App\Models\Outlate;
use App\Models\Promotion;
use App\Models\Visitor;
use Carbon\Carbon;
use DB;



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

        $bar_chart_data = Visitor::where('created_at', '>=', Carbon::now()->subMonths(12))
        ->select(
            DB::raw('count(id) as `total`'), 
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  
            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        )
        ->groupby('year','month')
        ->get();

        return view('admin.food.index', compact('totalPost', 'totalProduct', 'totalOutlate', 'totalPromotion', 'bar_chart_data'));




        // $bar_chart_data = Visitor::select(DB::Raw('DATE(created_at)'),  DB::raw('count(*) as total'))
        //     ->groupBy(DB::Raw('DATE(created_at)'))
        //     ->orderBy(DB::Raw('DATE(created_at)'), 'desc')
        //     ->get();

        // $bar_chart_data2 = Visitor::select(DB::Raw('MONTH(created_at) month'),  DB::raw('count(*) as total'))
        //     ->groupBy('month')
        //     //->orderBy(DB::Raw('MONTH(created_at)'), 'desc')
        //     ->get();

        
        // $bar_chart_data3 = Visitor::select(
        //         DB::raw('count(id) as `total`'), 
        //         DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  
        //         DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        //        )
        //    ->groupby('year','month')
        //    ->get();


        

        

        //     //date("F j, Y h:m:s A", strtotime($data->created_at))date("F", mktime(null, null, null, $result["month"], 1));
        // foreach($bar_chart_data as $item){
        //     echo 'Total '. $item->total . "<br>";
        //     echo 'Lavel mon '. date("F", mktime(0, 0, 0, $item->month, 1)) . "<br>";
        //     echo 'Lavel '.  $item->new_date . "<br>";
        //     echo 'month '. $item->month . "<br>";
        //     echo 'year '. $item->year . "<br>";

        //     echo "<hr>";
        // }

        // echo '<pre>';
        // print_r($bar_chart_data4);
        

        //dd($visitor_data, $bar_chart_data, $bar_chart_data2, $bar_chart_data3, $bar_chart_data4);



       
    }
}
