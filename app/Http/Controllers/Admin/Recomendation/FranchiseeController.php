<?php

namespace App\Http\Controllers\Admin\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Franchisee;
use DataTables;
use Validator;
use Gate;
use Auth;
use Carbon\Carbon;

class FranchiseeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //All Data
    public function Franchisee()
    {

        if (request()->ajax()) {
            $data = Franchisee::orderBy('id', 'desc')->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('register', function ($data) {
                    return date("F j, Y h:m:s A", strtotime($data->created_at));
                })

                ->rawColumns(['register'])
                ->make(true);
        }
        return view('admin.food.recomendation.franchisee');
    }
}
