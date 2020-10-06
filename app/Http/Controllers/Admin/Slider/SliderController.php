<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Image;
use Auth;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {

        if (request()->ajax()) {
            $data = Slider::with('publisher', 'creator')->latest('id');

            //dd($data);

            return DataTables::of($data)

                ->addColumn('ImgSrc', function ($data) {
                    $button = '';
                    if (!empty($data->image_small)) {
                        $button = '<img src="' . asset($data->image_small) . '" class="rounded mx-auto d-block" height="150" width="200" >';
                    } else {
                        $button = 'No Image';
                    }

                    return $button;
                })


                ->addColumn('details', function ($data) {
                    $button = '';

                    $button .= '<b>Header : </b>' . $data->header . '<br>';
                    $button .= '<b>Remarks : </b>' . $data->remarks . '<br>';

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
                            $button .= '<button type="button" id="' . $data->id . '" makeValue="1" class="activeStatus btn btn-warning btn-sm"> <i class="far fa-window-close"></i> Deactive</button>';
                        }
                    }

                    if (Gate::allows('edit')) {

                        $button .= '&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit" ></i> Edit</button>';
                    }


                    if (Gate::allows('delete')) {
                        $button .= '&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>';
                    }

                    if (empty($button)) {
                        return '<span class="text-danger" >  No Access</span>';
                    }

                    return $button;
                })

                ->rawColumns(['ImgSrc', 'details', 'action'])
                ->make(true);
        }
        return view('admin.food.all-slider');
    }

    //insert
    public function Store(Request $request)
    {
        if (Gate::denies('insert')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            'image' => 'required|max:1000|mimes:jpg,jpeg,png',
            'header' => 'required|max:20',
            'remarks' => 'required|max:100',

        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new Slider();

            $data->created_by = Auth::user()->id;
            $data->header = $request->header;
            $data->remarks = $request->remarks;

            $image = $request->file('image');
            if ($image) {
                $image_name = "slider" . Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/sliders/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/sliders/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;
            }


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
            $data = Slider::findOrFail($id);
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
            'image' => 'nullable|max:1000|mimes:jpg,jpeg,png',
            'header' => 'required|max:20',
            'remarks' => 'required|max:100',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            $data = Slider::find($id);
            $data->header = $request->header;
            $data->remarks = $request->remarks;
            $data->created_by = Auth::user()->id;
            $data->updated_at = Carbon::now();


            $image = $request->file('image');
            if ($image) {

                //Delete Image
                $image_path = $data->image;
                if (!empty($image_path)) {
                    //unlink(public_path($image_path));
                    unlink($image_path);
                }
                //Delete Small Image
                $image_small_path = $data->image_small;
                if (!empty($image_small_path)) {
                    unlink($image_small_path);
                }

                //Insert Image
                $image_name = "slider" . Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/sliders/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/sliders/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;
            }

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

        $data = Slider::findOrFail($id);

        //Delete Image
        $image_path = $data->image;
        if (!empty($image_path)) {
            //unlink(public_path($image_path));
            unlink($image_path);
        }
        //Delete Small Image
        $image_small_path = $data->image_small;
        if (!empty($image_small_path)) {
            unlink($image_small_path);
        }

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

        $data = Slider::find($id);

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
