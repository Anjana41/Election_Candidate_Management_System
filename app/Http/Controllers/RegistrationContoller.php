<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\register;

class RegistrationContoller extends Controller
{
    public function form()
    {
        return view('form1');
    }
    public function registerdata(Request $_request)
    {
        $_request-> validate(
            [
               'Name' =>'required',
               'Address' =>'required',
               'Email' =>'required|email',
               'Password' =>'required',
               'confirm_password' =>'required|same:Password',
            ]
            );

    }
    public function store(Request $request){
        echo"<pre>";
        print_r($request->all());

        $register = new register;
        $register->name=$request['Name'];
        $register->Email=$request['Email'];
        $register->address=$request['address'];
        $register->password=md5($request['password']);
        $register->save();

        return redirect('/register/view');
    }
    public function view()
    {
        $register=register::all();
        $data=compact('register');
        return view('register-view')->with($data);
    }
}

