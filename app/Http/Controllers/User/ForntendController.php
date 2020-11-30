<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Product;
use App\Models\About;
use App\Models\Contact;
use App\Models\Outlate;
use App\Models\Promotion;
use App\Models\Slider;
use App\Models\UserMailData;
use Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class ForntendController extends Controller
{
    public function Index()
    {


        $slider = Slider::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
        $postData = Post::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
        $productData = Product::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        $promotionalData = Promotion::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();


        //Shoe index Page
        return view('user.index', \compact('slider', 'postData', 'productData', 'promotionalData'));
    }

    public function AllProducts()
    {
        $allData = Product::where('status', '1')
            ->latest('id')
            ->paginate(6);
        return view('user.products')->with('allData', $allData);
    }

    public function ProductsDetails($id)
    {
        $singleData = Product::find($id);
        return view('user.product-details')->with('singleData', $singleData);
    }

    public function AllPosts()
    {
        $allData = Post::where('status', '1')
            ->latest('id')
            ->paginate(9);
        return view('user.posts')->with('allData', $allData);
    }

    public function PostsDetails($id)
    {
        $singleData = Post::find($id);
        return view('user.post-details')->with('singleData', $singleData);
    }

    public function About()
    {
        $messageData = About::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(1)
            ->first();
        //print_r($messageData);

        return view('user.about')->with('messageData', $messageData);
    }

    //Outlate
    public function Outlate($division)
    {
        $outlateData = Outlate::where('status', '1')
            ->where('division', $division)
            ->orderBy('local_area', 'asc')
            ->get();
        //echo "ok";

        return view('user.outlate')->with('outlateData', $outlateData)->with('division', $division);
    }

    //Contact
    public function Contact()
    {
        $contactData = Contact::where('status', '1')
            ->orderBy('id', 'desc')
            ->get();

        return view('user.contact', compact('contactData'));
    }

    //ContactMail
    public function ContactMail(Request $request)
    {

        $rules = array(
            'name' => 'required|max:255',
            'contact' => 'required|regex:/(01)[0-9]{9}/|max:11',
            //'email'    =>  'required|email|max:50',
            'details' => 'required|max:5000',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new UserMailData();

            $data->name      =   $request->name;
            $data->contact   =   $request->contact;
            $data->email     =   $request->email;
            $data->details   =   $request->details;

            $success = $data->save();

            $mailTo = 'syful.cse.bd@gmail.com';

            Mail::to($mailTo)->send(new UserMail($data));

            if ($success) {
                return response()->json(['success' => 'Successfully Email Send', 'icon' => 'success']);
            } else {
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }
    }

    //Promotions
    public function Promotions()
    {
        $allData = Promotion::where('status', '1')
            ->latest('id')
            ->paginate(6);

        return view('user.promotions', \compact('allData'));
    }

    //PromotionDetails
    public function PromotionDetails($id)
    {
        $singleData = Promotion::find($id);
        return view('user.promotion-details', \compact('singleData'));
    }
}
