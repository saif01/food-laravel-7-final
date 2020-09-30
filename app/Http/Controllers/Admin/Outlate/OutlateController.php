<?php

namespace App\Http\Controllers\Admin\Outlate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Outlate;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Auth;
use Carbon\Carbon;

class OutlateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {

        if (request()->ajax()) {
            $data = Outlate::with('creator', 'publisher')->latest('id');

            //dd($data);

            return DataTables::of($data)

                ->addColumn('action', function ($data) {

                    $button = '';

                    if (Gate::allows('publisher')) {

                        if ($data->status == 1) {
                            $button .= '<button type="button" id="' . $data->id . '" makeValue="0"  class="deactiveStatus btn btn-info btn-sm"><i class="fas fa-check-square"></i> Active</button>';
                        } else {
                            $button .= '<button type="button" id="' . $data->id . '" makeValue="1" class="activeStatus btn btn-warning btn-sm"> <i class="far fa-window-close"></i> Deactive</button>';
                        }
                    }

                    if (Gate::allows('edit')) {

                        $button .= '&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>';
                    }


                    if (Gate::allows('delete')) {
                        $button .= '&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash" ></i> Delete</button>';
                    }

                    if (empty($button)) {
                        return '<span class="text-danger" >  No Access</span>';
                    }

                    return $button;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.food.all-outlate');
    }

    //insert
    public function Store(Request $request)
    {
        if (Gate::denies('insert')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            'contact'   =>  'required|regex:/(01)[0-9]{9}/|max:11',
            'division'  =>  'required',
            'address'   =>  'required|min:3|max:500',
            'district'  =>  'required',
            'local_area'  =>  'required',
            'shop_name'  =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new Outlate();

            $data->district      =   $request->district;
            $data->local_area    =   $request->local_area;
            $data->shop_name      =   $request->shop_name;
            $data->contact      =   $request->contact;
            $data->division    =   $request->division;
            $data->address      =   $request->address;
            $data->latitude    =   $request->latitude;
            $data->longitude      =   $request->longitude;
            $data->created_by   =   Auth::user()->id;

            $success = $data->save();

            if ($success) {
                return response()->json(['success' => 'Successfully Inserted', 'icon' => 'success']);
            } else {
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }
    }

    //Edit
    public function Edit($id)
    {

        if (request()->ajax()) {
            $data = Outlate::findOrFail($id);
            return response()->json($data);
        }
    }

    //Update
    public function Update(Request $request)
    {

        if (Gate::denies('edit')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $id = $request->hidden_id;

        $rules = array(
            'contact'   =>  'required|regex:/(01)[0-9]{9}/|max:11',
            'division'  =>  'required',
            'address'   =>  'required|min:3|max:500',
            'district'  =>  'required',
            'local_area'  =>  'required',
            'shop_name'  =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            $data = Outlate::find($id);

            $data->district      =   $request->district;
            $data->local_area    =   $request->local_area;
            $data->shop_name      =   $request->shop_name;
            $data->contact      =   $request->contact;
            $data->division    =   $request->division;
            $data->address      =   $request->address;
            $data->latitude    =   $request->latitude;
            $data->longitude      =   $request->longitude;
            $data->created_by   =   Auth::user()->id;
            $data->updated_at   =   Carbon::now();


            $success = $data->save();

            if ($success) {
                return response()->json(['success' => 'Successfully Updated', 'icon' => 'success']);
            } else {
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }
    }


    //Delete
    public function Delete($id)
    {

        if (Gate::denies('delete')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = Outlate::findOrFail($id);


        $success = $data->delete();

        if ($success) {
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        } else {
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }


    //Status Active/Deactive
    public function Status($id, $val)
    {

        if (Gate::denies('publisher')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = Outlate::find($id);

        $data->status = $val;
        $data->published_by = Auth::user()->id;

        $success = $data->save();

        if ($success) {
            return response()->json(['success' => 'Successfully Updated', 'icon' => 'success']);
        } else {
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }
}
