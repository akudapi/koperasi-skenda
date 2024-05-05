<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user(){
        
        $data = User::get();

        return view('user', compact('data'));
        
    }

    public function usercreate(){
        return view('userCreate');
    }

    public function userstore(Request $request){
        $request->validate([
            'name'          => 'required|max:80',
            'email'         => 'required|email|unique:users,email',
            'level'         => 'required|in:user,admin',
            'password'      => 'required|min:6'
        ]);

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['level']          = $request->level;
        $data['password']       = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user');
    }

    public function useredit(Request $request, $id){
        $data = User::find($id);

        return view('userEdit',compact('data'));
    }

    public function userupdate(Request $request, $id){

        // dd(request()->all());
        $validator = Validator::make($request->all(),[
            'name'      => 'required|max:80',
            'email'     => 'required|email',
            'level'     => 'required|in:user,admin',
            'password'  => 'nullable|min:6',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['level']      = $request->level;

        if($request->password){
            $data['password']   = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('user');
    }

    public function userdelete(Request $request, $id){
        $data = User::find($id);

        if ($data) {
            $data ->delete();
        }

        return redirect()->route('user');
    }
}
