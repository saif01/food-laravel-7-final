<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;


use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Image;
use Auth;
use Carbon\Carbon;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Data
    public function All()
    {

        $categories = Category::orderBy('name')->get();

        if (request()->ajax()) {
            $data = Product::with('category', 'publisher', 'creator')->orderBy('id', 'desc')->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('ImgSrc', function ($data) {
                    $button = '';
                    if (!empty($data->image_small)) {
                        $button .= '<img src="' . asset($data->image_small) . '" class="rounded mx-auto d-block" height="100" width="150" ><br>';
                    }

                    if (!empty($data->image2_small)) {
                        $button .= '<img src="' . asset($data->image2_small) . '" class="rounded mx-auto d-block" height="100" width="150" ><br>';
                    }

                    if (!empty($data->image3_small)) {
                        $button .= '<img src="' . asset($data->image3_small) . '" class="rounded mx-auto d-block" height="100" width="150" >';
                    }

                    return $button;
                })


                ->addColumn('details', function ($data) {
                    $button = '';

                    $button .= '<b>Title : </b>' . $data->title . '<br>';
                    $button .= '<b>Price : </b>' . $data->price . ' /= Taka.<br>';
                    if ($data->category) {
                        $button .= '<b>Category : </b>' . $data->category->name . '<br>';
                    } else {
                        $button .= '<b>Category : </b> <span class="text-danger" >Not Found</span> <br>';
                    }

                    // if ($data->subcategory) {
                    //     $button .= '<b>Subcategory : </b>' . $data->subcategory->name . '<br>';
                    // } else {
                    //     $button .= '<b>Subcategory : </b> <span class="text-danger" > Not Found</span> <br>';
                    // }

                    $button .= '<br><b>Details : </b>' . $data->details . '<br>';

                    if ($data->creator) {
                        $button .= '<span class="text-muted"><b>Created By : </b>' . $data->creator->name . ', </span> ';
                    }

                    if ($data->publisher) {
                        $button .= ' <span class="text-muted"><b>Pablished By : </b>' . $data->publisher->name . ', </span><br>';
                    }

                    $button .= '<span class="text-muted"><b>Created At : </b>' . date("F j, Y h:m:s A", strtotime($data->created_at)) . '.</span><br>';

                    if ($data->created_at == $data->updated_at) {
                        $button .= '<span class="text-muted"><b>Updated At : </b>Not Updated Anymore.</span><br>';
                    } else {
                        $button .= '<span class="text-muted"><b>Updated At : </b>' . date("F j, Y h:m:s A", strtotime($data->updated_at)) . '.</span><br>';
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

                ->rawColumns(['ImgSrc', 'details', 'action'])
                ->make(true);
        }
        return view('admin.food.all-products', compact('categories'));
    }

    //SubCategory
    public function Subcategory(Request $request)
    {
        $cat_id  = $request->get('cat_id');
        $subCategoryData = Subcategory::where('cat_id', '=', $cat_id)->get();
        return response()->json($subCategoryData);
    }

    //insert
    public function Store(Request $request)
    {
        if (Gate::denies('insert')) {
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            'title'     =>  'required|unique:products|min:3|max:300',
            'price'     =>  'required',
            'cat_id'    =>  'required',
            //'sub_id'    =>  'required',
            'details'   =>  'required|min:3|max:40000',
            'image'     =>  'required|max:500|mimes:jpg,jpeg,png',
            'image2'    =>  'required|max:500|mimes:jpg,jpeg,png',
            'image3'    =>  'required|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new Product();

            $data->title    =   $request->title;
            $data->price    =   $request->price;
            $data->cat_id    =   $request->cat_id;
            //$data->sub_id    =   $request->sub_id;
            $data->details    =   $request->details;
            $data->created_by = Auth::user()->id;




            $image = $request->file('image');
            if ($image) {
                $image_name = "product" . Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/products/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/products/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;
            }



            $image2 = $request->file('image2');
            if ($image2) {
                $image2_name = "product" . Str::random(5);
                $ext = strtolower($image2->getClientOriginalExtension());
                $image2_full_name = $image2_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/products/small/';
                $image2_url_small = $upload_path_small . $image2_full_name;

                //Image2 Resize
                $resize_image2 = Image::make($image2->getRealPath());
                $resize_image2->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image2_full_name);

                //Original Image2 Upload Path
                $upload_path_original2 = 'public/images/products/original/';
                $image2_url_original = $upload_path_original2 . $image2_full_name;

                Image::make($image2)->save($image2_url_original);

                //Data Store In DB Object
                $data->image2_small = $image2_url_small;
                $data->image2 = $image2_url_original;
            }

            $image3 = $request->file('image3');
            if ($image3) {
                $image3_name = "product" . Str::random(5);
                $ext = strtolower($image3->getClientOriginalExtension());
                $image3_full_name = $image3_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small3 = 'public/images/products/small/';
                $image3_url_small = $upload_path_small3 . $image3_full_name;

                //Image3 Resize
                $resize_image3 = Image::make($image3->getRealPath());
                $resize_image3->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small3 . '/' . $image3_full_name);

                //Original Image3 Upload Path
                $upload_path_original3 = 'public/images/products/original/';
                $image3_url_original = $upload_path_original3 . $image3_full_name;

                Image::make($image3)->save($image3_url_original);

                //Data Store In DB Object
                $data->image3_small = $image3_url_small;
                $data->image3 = $image3_url_original;
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
            $main = Product::find($id);

            $subcategory = '';
            if ($main->sub_id) {
                // $subcategory .= Subcategory::where('id', $main->sub_id)->pluck('name')->toArray();
                $subcategory = Subcategory::find($main->sub_id);
            }

            return response()->json(['main' => $main, 'subcategory' => $subcategory]);
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
            'title'    =>  'required|min:3|max:300|unique:products,title,' . $id,
            'price'    =>  'required',
            'cat_id'   =>  'required',
            //'sub_id'   =>  'required',
            'details'  =>  'required|min:3|max:40000',
            'image'    =>  'nullable|max:500|mimes:jpg,jpeg,png',
            'image2'   =>  'nullable|max:500|mimes:jpg,jpeg,png',
            'image3'   =>  'nullable|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            $data = Product::find($id);

            $data->title    =   $request->title;
            $data->price    =   $request->price;
            $data->cat_id   =   $request->cat_id;
            //$data->sub_id   =   $request->sub_id;
            $data->details    = $request->details;
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
                $image_name = "post" . Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/posts/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/posts/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;
            }


            $image2 = $request->file('image2');
            if ($image2) {

                //Delete Image
                $image_path = $data->image2;
                if (!empty($image_path)) {
                    //unlink(public_path($image_path));
                    unlink($image_path);
                }
                //Delete Small Image
                $image_small_path = $data->image2_small;
                if (!empty($image_small_path)) {
                    unlink($image_small_path);
                }


                $image2_name = "product" . Str::random(5);
                $ext = strtolower($image2->getClientOriginalExtension());
                $image2_full_name = $image2_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/products/small/';
                $image2_url_small = $upload_path_small . $image2_full_name;

                //Image2 Resize
                $resize_image2 = Image::make($image2->getRealPath());
                $resize_image2->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image2_full_name);

                //Original Image2 Upload Path
                $upload_path_original2 = 'public/images/products/original/';
                $image2_url_original = $upload_path_original2 . $image2_full_name;

                Image::make($image2)->save($image2_url_original);

                //Data Store In DB Object
                $data->image2_small = $image2_url_small;
                $data->image2 = $image2_url_original;
            }

            $image3 = $request->file('image3');
            if ($image3) {

                //Delete Image
                $image_path = $data->image3;
                if (!empty($image_path)) {
                    //unlink(public_path($image_path));
                    unlink($image_path);
                }
                //Delete Small Image
                $image_small_path = $data->image3_small;
                if (!empty($image_small_path)) {
                    unlink($image_small_path);
                }


                $image3_name = "product" . Str::random(5);
                $ext = strtolower($image3->getClientOriginalExtension());
                $image3_full_name = $image3_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small3 = 'public/images/products/small/';
                $image3_url_small = $upload_path_small3 . $image3_full_name;

                //Image3 Resize
                $resize_image3 = Image::make($image3->getRealPath());
                $resize_image3->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($upload_path_small3 . '/' . $image3_full_name);

                //Original Image3 Upload Path
                $upload_path_original3 = 'public/images/products/original/';
                $image3_url_original = $upload_path_original3 . $image3_full_name;

                Image::make($image3)->save($image3_url_original);

                //Data Store In DB Object
                $data->image3_small = $image3_url_small;
                $data->image3 = $image3_url_original;
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

        $data = Product::findOrFail($id);

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

        $data = Product::find($id);

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
