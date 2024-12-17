<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminLogin;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    public function Loginadmin(){
        return view('login');
    }

    public function accptlogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
          ]);
          
          #admin
          $data = AdminLogin::where('email', $request->email)->first();
         
          if ($data) {
            if (Hash::check($request->password, $data->password)) {
              $request->session()->put('admin-auth', $data);
               return redirect('admin/dashboard')->with('successMessage','Succesfully logged in');
            }
          }
        return redirect()->back()->with(['dangerMessage'=>'Opps! You have entered invalid credentials']);
    }

    public function logout(){
      request()->session()->forget('admin-auth');
      return redirect('admin/login')->with('successMessage' , 'You have been logged out');
    }

    public function userList()
    {
      $users = DB::table('admin_logins')
      ->where('role', '!=', 'superadmin')
      ->get();
      return view('backend_views.user_list',compact('users'));
    }

    public function changePassword($id)
    {
      $user=DB::table('admin_logins')->where(['id'=>$id])->first();
      return view('backend_views.user_change_password',compact('user'));
    }

    public function passwordUpdate(Request $request)
    {
        // // Custom validation rules
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email|exists:admin_logins,email',
        //     'password' => 'required',
        //     'id' => 'required|exists:admin_logins,id'
        // ]);
    
        // // If validation fails, redirect back with errors
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
    
        try {
            // Find the user by ID using the Query Builder
            $user = DB::table('admin_logins')->where('id', $request->id)->first();
    
            if ($user) {
                // Update password
                DB::table('admin_logins')->where('id', $request->id)->update([
                    'password' => Hash::make($request->password),
                ]);
    
                // Redirect back with a success message
                return redirect()->back()->with('successMessage', 'Password updated successfully!');
            } else {
                return redirect()->back()->with('dangerMessage', 'User not found.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('dangerMessage', 'Something went wrong. Please try again.');
        }
    }

}
