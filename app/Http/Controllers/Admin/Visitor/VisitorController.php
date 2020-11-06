<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Visitor;
use DataTables;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {
        $all_data = Visitor::orderBy('id', 'desc')
        ->take(1000)
        ->get();
        // dd($data);   

        if (request()->ajax()) {

            $data = Visitor::take(1000)
            ->get();

            // $data = Visitor::orderBy('id', 'desc')
            // ->take(1000)
            // ->get();

            //dd($data);

            return DataTables::of($data)


            ->addColumn('register', function ($data) {
                //return date("F j, Y h:m:s A", strtotime($data->created_at));
                return date("F j, Y", strtotime($data->created_at));
            })

            ->rawColumns(['register'])
            ->make(true);
            
        }
        return view('admin.food.visitors', compact('all_data'));
    }
}
