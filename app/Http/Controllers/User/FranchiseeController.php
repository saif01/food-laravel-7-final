<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Franchisee;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\FranchiseeMail;

class FranchiseeController extends Controller
{
    //apply
    public function apply()
    {
        return view('user.franchisee');
    }

    //apply_action
    public function apply_action(Request $request)
    {

        $rules = array(
            'name'      => 'required|max:255',
            'age'       => 'required|max:100',
            'occupation'=> 'required|max:100',
            'location'  => 'required|max:100',
            'contact'   => 'required|regex:/(01)[0-9]{9}/|max:11',
            'email'     => 'nullable|email|max:50',
            'address'   => 'required|max:1000',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {

            //dd($request);

            $data = new Franchisee();

            $data->name      =   $request->name;
            $data->age       =   $request->age;
            $data->occupation =   $request->occupation;
            $data->gender    =   $request->gender;
            $data->email     =   $request->email;
            $data->contact   =   $request->contact;
            $data->location  =   $request->location;
            $data->address   =   $request->address;

            $success = $data->save();

            $mailTo = 'syful.cse.bd@gmail.com';

            Mail::to($mailTo)->send(new FranchiseeMail($data));

            if ($success) {
                return response()->json(['success' => 'Successfully Applied', 'icon' => 'success']);
            } else {
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }
    }
}
