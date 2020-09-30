<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use DataTables;
use Validator;
use Gate;
use DB;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {


        if (request()->ajax()) {
            $data = Role::get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('action', function ($data) {

                    $button = '';

                    $id = $data->id;

                    $roleData = DB::table('role_user')->where('role_id', $id)->first();

                    if ($roleData) {

                        return '<span class="text-danger" >  Already Used</span>';
                    } else {

                        if (Gate::allows('edit')) {
                            $button .= '<button type="button" id="' . $data->id . '" class="edit btn btn-primary btn-sm mr-1" ><i class="fas fa-edit"></i> Edit</button>';
                        }

                        if (Gate::allows('delete')) {
                            $button .= '<button type="button" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash" ></i> Delete</button>';
                        }

                        if (empty($button)) {
                            return '<span class="text-danger" >  No Access</span>';
                        }
                    }


                    return $button;
                })

                ->rawColumns(['action'])
                ->make(true);
        }



        return view('admin.food.all-roles');
    }


    //insert
    public function Store(Request $request)
    {

        if (Gate::denies(['insert'])) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error'], 403);
        }

        $rules = array(
            'name'    =>  'required|unique:roles|max:50',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //Make First capital
            $rName = ucwords(strtolower($request->name));

            $data = new Role();

            $data->name = $rName;
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

        $data = Role::findOrFail($id);

        if (request()->ajax()) {
            $data = Role::findOrFail($id);
            return response()->json($data);
        }
    }

    //Update
    public function Update(Request $request)
    {
        if (Gate::denies(['edit'])) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error'], 403);
        }


        $id = $request->hidden_id;

        $rules = array(
            'name'    =>  'required|unique:roles,name,' . $id,
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            $rName = ucwords(strtolower($request->name));

            $data = Role::findOrFail($id);

            $data->name = $rName;
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

        if (Gate::denies(['delete'])) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error'], 403);
        }

        $data = Role::findOrFail($id);
        $success = $data->delete();

        if ($success) {
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        } else {
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }
}
