<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersBlogs;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;
use Mail;
use App\Jobs\UserMailJobs;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // if (!empty($_POST['g-recaptcha-response'])) //Check the captcha-click or not.
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'date_of_birth' => 'required',
            'confirm_password' => 'required'
        ]);
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.env('RECAPTCHAV3_SECRET').'&response=' . $request->get('g-recaptcha-response'));
        $responseData = json_decode($verifyResponse);

        $token = Str::random(64);
       	$user = new User;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->date_of_birth = $request->date_of_birth;
		$user->remember_token = $token;
		$user->save();
        try{
            dispatch(new UserMailJobs($user->email, $token)); 
            return redirect('/login')->with('success', 'User Added successfully!');
        }catch(\Exception $e){
            // $data = errorResponse($e->getMessage());
            return redirect('/user/create')->with('error', $e->getMessage());;
        }
        // return response()->json($data);

		// Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
        //       $message->to($request->email);
        //       $message->subject('Email Verification Mail');
        // });
		// return redirect('/login');
    }
    public function login()
    {
    	return view('user.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->email_verified_at != null){
                return redirect('user/blogs')
                        ->withSuccess('You have Successfully loggedin');
            }
            return redirect("login")->withError('Please verify email.');
        }
  
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
    public function userBlogs(){

    	//$blogs = UsersBlogs::with([['blogs'],['users']])->where('user_id',Auth::id())->get();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function verifyAccount($token)
    {
        $verifyUser = User::where('remember_token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            if(!$verifyUser->is_email_verified) {
                $verifyUser->email_verified_at = now();
                $verifyUser->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
    }
}


