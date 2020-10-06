<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use Gate;
use Carbon\Carbon;
use Auth;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {


        if (request()->ajax()) {
            $data = Category::orderBy('id', 'asc')->with('user')->get();


            return DataTables::of($data)

                ->addColumn('action', function ($data) {

                    $button = '';

                    if (Gate::allows('edit')) {
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm" ><i class="fas fa-edit"></i> Edit</button>';
                    }

                    if (Gate::allows('delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash" ></i> Delete</button>';
                    }

                    if (empty($button)) {
                        return '<span class="text-danger" >  No Access</span>';
                    }

                    return $button;
                })

                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.food.category.all');
    }


    //insert
    public function Store(Request $request)
    {
        if (Gate::denies(['insert'])) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }


        $rules = array(
            'name'    =>  'required|unique:categories|max:50',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //Make First capital
            //$rName = ucwords(strtolower($request->name));

            $data = new Category();

            $data->name = $request->name;
            $data->created_by = Auth::user()->id;
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


        $data = Category::findOrFail($id);

        if (request()->ajax()) {
            $data = Category::findOrFail($id);
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
            'name'    =>  'required|unique:categories,name,' . $id,
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //$rName = ucwords(strtolower($request->name));

            $data = Category::findOrFail($id);

            $data->name         = $request->name;
            $data->created_by   = Auth::user()->id;
            $success            = $data->save();

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

        $data       = Category::findOrFail($id);
        $success    = $data->delete();

        if ($success) {
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        } else {
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }
}
