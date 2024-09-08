<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Flash;
use Sentinel;
class AuthAdminController extends Controller
{
  public $arr_view_data;
  public $admin_panel_slug;

  public function __construct()
  {
      $this->arr_view_data    = [];
      $this->admin_panel_slug = config('app.project.admin_panel_slug');
  }
  public function login()
  {

      $page_title = "Admin Login ";
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title']       = "Login";

      return view('admin.auth.login',$this->arr_view_data);
  }
  public function process_login(Request $request)
  {
      $validator = Validator::make($request->all(),[
        'email'    => 'required|max:255',
        'password' => 'required'
      ]);
      if($validator->fails())
      {
        redirect(config('app.project.admin_panel_slug').'/login')
            ->withErrors($validator)
            ->withInput($request->all());
      }

      $login_details =[
              'email' => $request->input('email'),  
              'password' => $request->input('password'),
      ];
      
      $check_auth = Sentinel::authenticate($login_details);
      if($check_auth)
      {
          $user = Sentinel::check();
          if($user->inRole('admin'))
          {
            return redirect(config('app.project.admin_panel_slug').'/dashboard');
          }
          else
          {
            $request->session()->flash('error', 'No Sufficient Privileges.');
            return redirect(config('app.project.admin_panel_slug').'/login');
          }
      }
      else
      {
        $request->session()->flash('error', 'Invalid Login Credential.');
        return redirect(config('app.project.admin_panel_slug').'/login');
      }      
 
    }
}
