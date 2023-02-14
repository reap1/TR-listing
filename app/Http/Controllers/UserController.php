<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Models\Nuser;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class UserController extends Controller
{
    
    // show sign in form
    public function index(){

        

        /*------------------------------------------*/
        $loged = session()->get('LoggedUser', 'tuse');
        return view('user.login',compact('loged'));


        

    } 
    // show register form
    public function sign_up(){
        return view('user.register');
    }

    //login
    public function loguser(Request $request){
        
        
        $tuse = Nuser::where('email', '=', $request->email)->first();
        if(!$tuse){
            return redirect()->back()->with('Lmessage', 'Account Not Found!');
            
        }else{
            if(Hash::check($request->password, $tuse->password)){
               
                $request->session()->put('LoggedUser', $tuse);

               
                // Login
                return redirect('home')->with('message', 'Sign In Success!');;
            }else{  
                return back()->with('Lmessage', 'Incorrect Password ');
            }
        }
    }

    

// register
public function adduser(Request $request){
    $validateData = $request->validate([
        'name' => ['required', 'min:3'],
        'email' => 'unique:Nusers',
        'password' => 'required|confirmed|min:6'
    ]);
    
    $treg = new Nuser;
    $treg->email = $request->email;
    $treg->name = $request->name;
    $treg->password = Hash::make($request->password);
    $save = $treg->save();

    if($save){
        $tuse = Nuser::where('email', '=', $request->email)->first();
       
                $request->session()->put('LoggedUser', $tuse);
 
                // Login
                return redirect('/home')->with('message', 'Register Succsess And Signed In!');
            

       
    }
    else{
        redirect('/sign-up')->with('Lmessage', 'Register Error!');
    }
}

  
public function home(){
    $listings = Listing::orderby('id','asc')->get();
    return view('listings.index',compact('listings'));
}


    
    public function off(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }

public function manage(){
    $userid = session()->get('LoggedUser')->id;
    $mylist = Listing::where('uid','=',$userid)->get();
    
    return view('list.index',compact('mylist'));
}
 
}
