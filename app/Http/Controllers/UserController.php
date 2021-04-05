<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserModel;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Redirect, Response, Session;
use Hash;
use Mail;
use App;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{

    public function registerCreate(Request $request) {
        $request->session()->flush();
        return view('user.registerForm');
    }

    public function registerSubmit(Request $request) {
        request()->validate([
            'name' => 'required',
            'username' => 'required|min:6|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20'
        ], [
            'username.required' => 'Name is required',
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be atleast 6 characters',
            'password.max' => 'Password cannot exceed 20 characters'
        ]);

        $username = request('username');
        $email = request('email');

        $data = ['username' => $username, 'email' => $email];

        $input = request()->except('password');

        $user = new UserModel($input);

        $user->pwd_plain = request('password');
        $user->userlevel = '2';
        
        $user->password = HASH::make(request()->password);
        
        $permitted_chars = Str::random(40);
        $token = substr(($permitted_chars), 0, 40);
        session(['verifytoken' => $token]);
        session(['verifyemail' => $email]);

        Mail::send('user.registrationVerifyMail', $data, function($message){
            $token_sess = session('verifytoken');
            $msg = env('APP_URL').'/verifyemail?token='.$token_sess;
            session(['verifymsg' => $msg]);
            $email_id = session('verifyemail');
            $message->to($email_id)->subject("Verify your email for " .env('MAIL_FROM_NAME'). " admin account");
            $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
            });
            $email_id = session('verifyemail');
            $token_sess = session('verifytoken');

        $user->save();
        $user_id = $user->id;

        UserModel::where('email', '=', $email_id)->update(['verify_token' => $token_sess]); 
        $data = ['code' => '200', 'status' => 'success', 'message' => 'An activation email has been sent your mail id, please activate to continue.', 'email' => $email];
        
        return redirect('/')->with($data);
    }

    public function verifyEmail(Request $request) {
        
        $key = $request->input('token');
        if ($key != "") {
            $token_db = UserModel::where('verify_token', '=', $key)->value('verify_token');
            $vs = UserModel::where('verify_token', '=', $key)->value('verify_status');
            if($vs == 0) {
                if($key == $token_db) {
                    UserModel::where('verify_token', '=', $key)->update(['verify_status' => 1]);
                    $permitted_chars = Str::random(40);
                    $token = substr(($permitted_chars), 0, 40);
                    UserModel::where('verify_token', '=', $key)->update(['verify_token' => $token]);
                    $data = ['code' => '200', 'status' => 'success', 'message' => "Email has been verified successfully"];
                    return redirect('/')->with($data);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function loginCreate(Request $request) {
        //$request->session()->flush();
        if(!empty(session('id'))) {
            return redirect('dashboard');
        } else {
            return view('user.loginForm');
        }
    }

    public function loginSubmit(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ],
        [
             'username.required' => 'Username is required',
             'password.required' => 'Password is required',
         ]);
 
         $username 		= $request->input('username');
         $password 		= $request->input('password');
 
         $result 		= UserModel::where('username', $username)->get();
         $verified 		= UserModel::where('username', $username)->value('verify_status');
         $is_active 	= UserModel::where('username', $username)->value('is_active');
 
         if(count($result)>0) {
             $remember = $request->input('remember_me');
 
           if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
               if($is_active == 1) {
                 if ($verified == 1) {
                     $id = Auth::id();
                     $username = Auth::user()->username;
                     $userLevel = Auth::user()->userlevel;
                     $user = auth()->user();
                     Auth::login($user,true);

                     /**
                      * Save login data in session
                      */
                     session(['id' => $id]);
                     session(['sess_uname' => $username]);
                     session(['userLevel' => $userLevel]);
                     session(['is_logged' => 'true']);
                     session()->save();

                     if (Auth::viaRemember()) {
                         if($userLevel == "1") {
                            return redirect('dashboard');
                         } elseif($userLevel == "2") {
                             return redirect()->route('dashboard');
                         } else {
                            return redirect('/');
                         }
                     }

                    if($userLevel == '1') {
                        Auth::logoutOtherDevices($password);
                        return redirect('dashboard');
                    } elseif($userLevel == "2") {
                        return redirect()->route('dashboard');
                    } else {
                        Auth::logoutOtherDevices($password);
                        return redirect('/');
                    }
                    
                 } elseif($verified == 0) {
                     $activationError = ['verifymessage' => 'Please verify your email', 'verifycode' => '201'];
                     return back()->with($activationError);
                 }
             } else {
                 $userStatusError = ['message' => 'Your account has been suspended. Contact support for more details', 'code' => '201'];
                 return redirect()->back()->withErrors($userStatusError);
             }
             } else {
                 $data = ['code' => '101', 'status' => 'failure', 'message' => 'Username or Password is Incorrect'];
                return back()->with($data);
              }
         } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Username or Password is Incorrect'];
                return back()->with($data);
           }

        return redirect('dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotCreate() {
        return view('user.forgotPassword');
    }

    public function forgotSubmit(Request $request) {
        $email = $request->email;
        $user = UserModel::where('email', $email)->first();
        
        if (!$user) { //Check if the user exists
            $data = ['code' => '101', 'status' => 'failure', 'message' => 'Entered email not found'];
            return back()->with($data);
        }   else { //Create Password Reset Token
            $previous_token = PasswordReset::where('email', $email)->where('is_active', '1')->first();
            if(!$previous_token) {
                $pr = new PasswordReset();
                $pr->email = $email;
                $pr->token = Str::random(60);
                $pr->save();

                //Get the token just created above
                $tokenData = PasswordReset::where('email', $email)->where('is_active', '1')->first();
                $token = $tokenData->token;

                $name = $user->name;
                $email = $user->email;
                session(['email' => $email]);        
                $data = ['name' => $name, 'email' => $email];
                //Generate, the password reset link. The token generated is embedded in the link
                $link = '/reset-password/' . $token;
                session(['link' => $link]); 
            
                try {
                    //Here send the link with CURL with an external email API 
                    Mail::send('user.resetPasswordTemplate', $data, function($message){
                    $links = session('link');                
                    $msg = env('APP_URL').$links;
                    session(['msg' => $msg]);
                    $email_id = session('email');
                    $message->to($email_id)->subject("Reset Password - " .env('MAIL_FROM_NAME'));
                    $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                });
                    $data = ['code' => '200', 'status' => 'success', 'message' => 'A reset link has been sent to your email address'];
                    return back()->with($data);
                } catch (\Exception $e) {
                    $data = ['code' => '101', 'status' => 'failure', 'message' => 'A Network Error occurred. Please try again'];
                    return back()->with($data);
                }
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'A previous reset request is still pending'];
                
                return back()->with($data);
            }
        }
    }    
    public function resetPasswordCreate(Request $request, $token) {
        $resetpasswordcreate = PasswordReset::where('token', $token)->first();
        if($resetpasswordcreate) {
            $data=['resetpasswordcreate' => $resetpasswordcreate];
            return view('user.resetPassword')->with($data);
        } else {
            abort('404');
        }   
    }

    public function resetPasswordSubmit(Request $request, $token) {

        $this->validate($request, [
            'password' => 'required',
            'confirm_password' => 'required',
        ],
        [
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
         ]);

        $password = request('password');
        $confirm_password = request('confirm_password');

        if($password == $confirm_password) {        
            // Validate the token
            $tokenData = PasswordReset::where('token', $token)->where('is_active', '1')->first();
            if($tokenData) {
                $user = UserModel::where('email', $tokenData->email)->where('is_active', '1')->first();
                $user->password = HASH::make($password);
                $user->update();

                //Deactivate the token
                PasswordReset::where('email', $user->email)->where('token', $tokenData->token)->update(['is_active' => '0']);
                $data = ['code' => '200', 'status' => 'success', 'message' => 'Password Reset Success'];

                return redirect('/')->with($data);
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Password reset failed'];

                return back()->with($data);
            }
        } else {
            $data = ['code' => '101', 'status' => 'failure', 'message' => 'Password not matching'];

            return back()->with($data);
        }
    }

    public function allUsers(Request $request) {
        $users = UserModel::all();
        $data = ['users' => $users];
        return view('users')->with($data);
    }
}