<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class UserController extends Controller
{
    //

     function memberPage(){

        $user = Member::whereNot('id', 0)->where('status' , operator: 'active')->get();
        return view('member')->with('user',$user);
    }

     function addMemberPage(){

       
        return view('addMem');
    }

    function addMember(Request $request){
        $request->validate([
            'firstName' => 'required|string|max:255', 
            'lastName' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'phoneNumber' => 'required|digits:10',
            'birthday' => 'required'
        ]);
        

        $data = [
             'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'nickname' => $request->input('nickname'),
            'phoneNumber' => $request->input('phoneNumber'),
            'birthDay' => $request->input('birthday'),
            'role' => $request->input('role')
        ];

        if($request->input('mode') == 'edit'){
            
            Member::find($request->input('id'))->update($data);
        }else{
            Member::create($data);
        }

        

        return redirect()->route('memberPage');
    }

    function editMemberForm($id){

        $user = Member::find($id);

        return view('editMem')->with('user' , $user);
    }

    function deleteMember($id){
        
        $user = Member::find($id)->update(['status' => 'inactive']);

        return redirect()->back();
    }


}
