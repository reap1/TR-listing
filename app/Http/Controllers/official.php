<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\officials;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\ValidatedData;


class official extends Controller
{
    //

    public function indexoff($loc,$brg){
        $listings = Listing::orderby('id','asc')->get();
        $mylist = Listing::where('location','=',$loc)->first();
        $label = Listing::where('location','=',$loc)->where('brgname','=',$brg)->first();
        $officials = officials::where('location','=',$loc)->where('brgname','=',$brg)->get();
        $min=officials::where('location','=',$loc)->where('brgname','=',$brg)->min('id');
        $maplink="https://goo.gl/maps/co7zVvbrvtsGFmdKA";
        return view('listings.index-office',compact('listings','officials','label','min','maplink','mylist'));
        
        
    }

    public function officialMview($loc,$brg){
        
        $userid = session()->get('LoggedUser')->id;
        $mylist = Listing::where('uid','=',$userid)->get();
        $label = Listing::where('location','=',$loc)->where('brgname','=',$brg)->first();

        $ofc = officials::where('brgname','=',$brg)->where('location','=',$loc)->get();
        
        return view('list.official.manage',compact('ofc','mylist','label'));
    }

    public function add(Request $request,$loc,$brg){

        $deficon ="user-logo.jpg";
        $input = $request->all();

        if(request()->allFiles()){
            $request->validate([
                'pp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($icon = $request->file('pp')) {
                $destinationPath = 'profile/';
                $ppImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
                $icon->move($destinationPath, $ppImage);
                $input['pp'] = "$ppImage";
            }
        
        }
        else{
            $input['pp'] = "$deficon";
        }
        $input['location'] = "$loc";
        $input['brgname'] = "$brg";
        officials::create($input);
        return redirect()->back()->with('massage','Sucess');
/*
        $of = new officials();
        $of->position = $request->position;
        $of->fname = $request->fname;
        $of->lname = $request->lname;
        $of->contact = $request->contact;
        $of->sex = $request->sex;
        $of->location = $loc;
        $of->brgname = $brg;
        
        $add = $of->save();
        if($add){
            return redirect()->back()->with('massage','Sucess');
        }
        else{
            return redirect()->back()->with('massage','Fail');
        }
*/
    }

    public function edit($loc,$brg,$id){
        
        $userid = session()->get('LoggedUser')->id;
        $mylist = Listing::where('uid','=',$userid)->get();
        $label = Listing::where('location','=',$loc)->where('brgname','=',$brg)->first();

        $ofc = officials::where('brgname','=',$brg)->where('location','=',$loc)->get();
        $data = officials::where('id','=',$id)->first();
        return view('list.official.edit',compact('ofc','mylist','label','data'));
    }

    public function update(Request $request,$loc,$brg,$id){
        
        dd($id);
        $thisitem = officials::where('id','=',$id)->first();
        $deficon ="user-logo.jpg";

        $input = $request->all();
       
        if(request()->allFiles()){
            $request->validate([
                'pp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            if ($icon = $request->file('pp')) {
                $destinationPath = 'profile/';
                $iconImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
                $icon->move($destinationPath, $iconImage);
                $input['pp'] = "$iconImage";
               
            }
            if($thisitem->pp!=$deficon){
                File::delete('profile/'.$thisitem->pp);
            }
        }
        else{ 
            $input['pp'] = "$thisitem->pp";
        }


       

         $update = officials::where('id','=',$id)->where('location','=',$loc)->where('brgname','=',$brg)->update([
            'position'=> $request->position,
            'fname'=> $request->fname,
            'lname'=> $request->lname,
            'contact'=> $request->contact,
            'sex'=> $request->sex,
            'location'=> $loc,
            'brgname'=> $brg,
            'pp' => $input['pp'],
        ]);
        if($update){
            return redirect('/view-officials/'.$loc.'/'.$brg)->with('message',"Data Updated : {$request->brgname} | {$request->location}");
       }  else{
        return redirect('/view-officials/'.$loc.'/'.$brg)->with('Lmessage',"Something Went Wrong!");
        } 
    
    


        /* ----------------------------------------------- 

        $update = officials::where('id','=',$id)->where('location','=',$loc)->where('brgname','=',$brg)->update([
            'position'=> $request->position,
            'fname'=> $request->fname,
            'lname'=> $request->lname,
            'contact'=> $request->contact,
            'sex'=> $request->sex,
            'location'=> $loc,
            'brgname'=> $brg,
        ]);
        if($update){
            return redirect()->back()->with('message',"{$request->lname}'s Data Updated!");
        }
        else{
            return redirect()->back()->with('Lmessage',"Something Went Wrong!");
        }
    }

    public function deleteOFF($loc,$brg,$id){
        $thisitem = officials::where('id','=',$id)->first();
        $delitem = officials::where('id','=',$id)->where('location','=',$loc)->where('brgname','=',$brg)->delete();
        if($delitem){
            return redirect()->back()->with('message',"{$thisitem->lname}'s Data Deleted!");
        }
        else{
            return redirect('/view-officials/{location}/{brgname}')->with('Lmessage',"Something Went Wrong!");
        }*/
    }
    
    public function dellall($loc,$brg)
    {
        $cls = officials::where('location','=',$loc)->where('brgname','=',$brg)->delete();
        if ($cls) {
            return redirect()->back()->with('message', 'Sucessfully Deleted!');
        }
        else{
            return redirect()->back()->with('Lmessage', 'Something Went Wrong!');
        }
    }
}
