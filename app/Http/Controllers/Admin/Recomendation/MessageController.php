<?php

namespace App\Http\Controllers\Admin\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserMailData;
use DataTables;
use Validator;
use Gate;
use Auth;
use Carbon\Carbon;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //All Data
    public function Message()
    {

        if (request()->ajax()) {
            $data = UserMailData::orderBy('id', 'desc')->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('register', function ($data) {
                    return date("F j, Y h:m:s A", strtotime($data->created_at));
                })

                ->rawColumns(['register'])
                ->make(true);
        }
        return view('admin.food.recomendation.message');
    }
}
