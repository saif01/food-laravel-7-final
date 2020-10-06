<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {

        if (request()->ajax()) {
            $data = Contact::with('creator', 'publisher')->get();

            //dd($data);

            return DataTables::of($data)


                ->addColumn('details', function ($data) {
                    $button = '';

                    $button .= '<b>Contact : </b>' . $data->contact . '<br>';
                    $button .= '<b>Telephone : </b>' . $data->telephone . '<br>';
                    $button .= '<b>E-mail : </b>' . $data->email . '<br>';
                    $button .= '<b>Address : </b>' . $data->address . '<br>';

                    if ($data->creator) {
                        $button .= '<span class="text-muted"><b>Created By : </b>' . $data->creator->name . '</span>';
                    }

                    if ($data->publisher) {
                        $button .= ', <span class="text-muted"><b>Pablished By : </b>' . $data->publisher->name . '.</span><br>';
                    }

                    $button .= '<span class="text-muted"><b>Created At : </b>' . date("F j, Y h:m:s A", strtotime($data->created_at)) . '.</span><br>';

                    if ($data->created_at == $data->updated_at) {
                        $button .= '<span class="text-muted"><b>Updated At : </b>Not Updated Anymore.</span>';
                    } else {
                        $button .= '<span class="text-muted"><b>Updated At : </b>' . date("F j, Y h:m:s A", strtotime($data->updated_at)) . '.</span>';
                    }



                    if (empty($button)) {
                        return 'No data';
                    }

                    return $button;
                })


                ->addColumn('action', function ($data) {

                    $button = '';

                    if (Gate::allows('publisher')) {

                        if ($data->status == 1) {
                            $button .= '<button type="button" id="' . $data->id . '" makeValue="0"  class="deactiveStatus btn btn-info btn-sm"><i class="fas fa-check-square"></i> Active</button>';
                        } else {
                            $button .= '<button type="button" id="' . $data->id . '" makeValue="1" class="activeStatus btn btn-warning btn-sm"><i class="far fa-window-close"></i> Deactive</button>';
                        }
                    }

                    if (Gate::allows('edit')) {

                        $button .= '<button type="button" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>';
                    }


                    if (Gate::allows('delete')) {
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash" ></i> Delete</button>';
                    }

                    if (empty($button)) {
                        return '<span class="text-danger" >  No Access</span>';
                    }

                    return $button;
                })

                ->rawColumns(['details', 'action'])
                ->make(true);
        }
        return view('admin.food.all-contact');
    }

    //insert
    public function Store(Request $request)
    {
        if (Gate::denies('insert')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            //'contact'   =>  'required|regex:/(01)[0-9]{9}/|max:11',
            'contact'   =>  'required',
            'email'     =>  'required|email',
            'address'   =>  'required|min:3|max:20000',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new Contact();

            $data->contact      =   $request->contact;
            $data->telephone    =   $request->telephone;
            $data->email        =   $request->email;
            $data->address      =   $request->address;
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
            $data = Contact::findOrFail($id);
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
            'contact'   =>  'required',
            'email'     =>  'required|email',
            'address'   =>  'required|min:3|max:20000',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            $data = Contact::find($id);

            $data->contact      =   $request->contact;
            $data->telephone    =   $request->telephone;
            $data->email        =   $request->email;
            $data->address      =   $request->address;
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

        $data = Contact::findOrFail($id);


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

        $data = Contact::find($id);

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
