<?php

namespace App\Http\Controllers;

use App\User; //remember
Use App\Role;
Use App\VerifyController;
use Illuminate\Http\Request; //remember
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function getDashboard()
    {
        return view('dashboard');
    }

    public function getUserChange()
    {
        $users = User::all();
        return view('changeuser', ['users' => $users]);
    }

    public function getAdmin()
    {
        $users = User::all();
        return view('admin', ['users' => $users]);
    }    

    public function getLogin()
    {
        return view('login');
    }

    public function getWelcome()
    {
        return view('welcome');
    }

    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|unique:users',
            'first_name' => 'required|max: 120',
            'password' => 'required| min:4'
        ]);
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);
        $token = str_random(25);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;
        $user->profile_pic= 'default.svg';
        $user->remember_token = $token;
        $user->save();
        $user->roles()->attach(Role::where('name', 'User')->first());
        Auth::login($user);
        return redirect()->route('dashboard');

    }
    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'password' => 'required'
        ]);

       if (Auth::attempt(['first_name' => $request['first_name'], 'password' => $request['password']]))
       {
            return redirect()->route('dashboard');       
        }
    return redirect()->back();
    }

    public function uploadImage()
    {
        return view('dashboard');
    }

    public function uploadImagePost(Request $request)
    {
        $user = Auth::user();
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'          
        ]);

        $profileImage = 'user_'.time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('storage/profile/profile-pic'), $profileImage);

     
            $user->profile_pic = $profileImage;

        $user->save();
        return back()
        ->with('success','Updated Profile Pic!');
    }



    public function getLogout()
    {

        Auth::logout(); 
        return redirect()->route('welcome');
        
    }

   



    
}




