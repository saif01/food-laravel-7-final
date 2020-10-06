<?php

namespace App\Http\Controllers\Admin\Subcategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Carbon\Carbon;
use Auth;

class SubcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {

        $categoryData = Category::orderBy('id', 'asc')->get();

        if (request()->ajax()) {

            $data = Subcategory::with('user', 'category')->get();

            // $data = Category::with('user')->latest('id');


            //dd($data);
            return DataTables::of($data)

                ->addColumn('categoryData', function ($data) {
                    if ($data->category) {
                        return $data->category->name;
                    } else {
                        return '<span class="text-danger" id="' . $data->id . '" >Not-Found !!</span>';
                    }
                })

                ->addColumn('action', function ($data) {

                    $button = '';

                    if (Gate::allows('edit')) {
                        $button .= '<button type="button" id="' . $data->id . '" class="edit btn btn-primary btn-sm mr-1" ><i class="fas fa-edit"></i> Edit</button>';
                    }

                    if (Gate::allows('delete')) {
                        $button .= '<button type="button" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash" ></i> Delete</button>';
                    }

                    if (empty($button)) {
                        return '<span class="text-danger" >  No Access</span>';
                    }

                    return $button;
                })

                ->rawColumns(['categoryData', 'action'])
                ->make(true);
        }


        return view('admin.food.subcategory.all', compact('categoryData'));
    }


    //insert
    public function Store(Request $request)
    {
        if (Gate::denies(['insert'])) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }


        $rules = array(
            'name'    =>  'required|unique:subcategories|max:50',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //Make First capital
            //$rName = ucwords(strtolower($request->name));

            $data = new Subcategory();
            $data->name         = $request->name;
            $data->cat_id       = $request->cat_id;
            $data->created_by   = Auth::user()->id;
            $success            = $data->save();


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


        $data = Subcategory::findOrFail($id);

        if (request()->ajax()) {
            $data = Subcategory::findOrFail($id);
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
            'name'    =>  'required|unique:subcategories,name,' . $id,
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //$rName = ucwords(strtolower($request->name));

            $data = Subcategory::findOrFail($id);

            $data->name         = $request->name;
            $data->cat_id       = $request->cat_id;
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

        $data       = Subcategory::findOrFail($id);
        $success    = $data->delete();

        if ($success) {
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        } else {
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }
}
