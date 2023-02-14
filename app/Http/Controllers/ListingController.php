<?php

namespace App\Http\Controllers;

use App\Models\Listing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller 
{
    //
    public function addlist(Request $request)
    {
        $deficon ="default.png";
         
        $userid = session()->get('LoggedUser')->id;
        $input = $request->all();

        if(request()->allFiles()){
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($icon = $request->file('logo')) {
                $destinationPath = 'logo/';
                $iconImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
                $icon->move($destinationPath, $iconImage);
                $input['logo'] = "$iconImage";
                $input['uid'] = "$userid";
            }
        
        }
        else{
            $input['logo'] = "$deficon";
            $input['uid'] = "$userid";
        }
        Listing::create($input);
    
        return redirect('listings/manage')->with('message', 'Successfully added!');
/*

       /*  $userid = session()->get('LoggedUser')->id;

        $lt = new Listing();
        $lt->location = $request->location;
        $lt->brgname = $request->brgname;
        $lt->link = $request->link;
        $lt->uid = $userid;
       


            if($request->file('logo')){
                $file= $request->file('logo');
                $fileName= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/logo'), $fileName);
                $lt['logo']= $fileName;
            }

        $add = $lt->save();
        if ($add) {
            return redirect('listings/manage')->with('message', 'Successfully added!');
        } else {
            return redirect('listings/manage')->with('Lmessage', 'Something Went Wrong!');
        }*/ 
    }


    public function dellall()
    {
        $userid = session()->get('LoggedUser')->id;
        

        $thisitem = Listing::where('uid','=',$userid)->get();
        
        $deficon ="default.png";
        foreach($thisitem as $items){
          
            if($items->logo !=  $deficon){
                File::delete('logo/'.$items->logo);
            }
        }
        $cls = Listing::where('uid', '=', $userid)->delete();
        if ($cls) {
        return redirect('/listings/manage')->with('message', 'Sucessfully Deleted All Records!');
        }
        else{
            return redirect('/listings/manage')->with('Lmessage', 'Something Went Wrong!');
        }
    }

    public function edit($id){
        $userid = session()->get('LoggedUser')->id;
        $mylist = Listing::where('uid','=',$userid)->get();

        $myitem = Listing::where('id','=',$id)->first();
        return view('list.edit',compact('myitem','mylist'));
    }

    public function deleteitem($id){
        $thisitem = Listing::where('id','=',$id)->first();
        $deficon ="default.png";
        if($thisitem->logo !=  $deficon){
            File::delete('logo/'.$thisitem->logo);
        }
        
        $delitem = Listing::where('id','=',$id)->delete();
        if($delitem){
            return redirect('/listings/manage')->with('message',"Successfully deleted : {$thisitem->brgname} , {$thisitem->location} ");
        }
        else{
            return redirect('/listings/manage')->with('Lmessage',"Something Went Wrong!");
        }
    }

    public function updateitem(Request $request,$id,Listing $listing){
        $thisitem = Listing::where('id','=',$id)->first();
        $deficon ="default.png";
       
        $request->validate([
            'location' => 'required',
            'brgname' => 'required',
        ]);

        $userid = session()->get('LoggedUser')->id;

        $input = $request->all();
        if(request()->allFiles()){
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($icon = $request->file('logo')) {
                $destinationPath = 'logo/';
                $iconImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
                $icon->move($destinationPath, $iconImage);
                $input['logo'] = "$iconImage";
                $input['uid'] = "$userid";
            }
            if($thisitem->logo!=$deficon){
                File::delete('logo/'.$thisitem->logo);
            }
        }
        else{
            $input['logo'] = "$deficon";
            $input['uid'] = "$userid";
        }


       

        $update = Listing::where('id','=',$id)->update([
            'location' => $request->location,
            'brgname' => $request->brgname,
            'link' => $request->link,
            'logo' =>  $input['logo'],
        ]); 
        if($update){
            return redirect('/listings/manage')->with('message',"Data Updated : {$request->brgname} | {$request->location}");
       }  else{
            return redirect('/listings/manage')->with('Lmessage',"Something Went Wrong!");
        } 
    }
}
