<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|max:20'
        ]);
        //redirect->back()->withErrors([])->withInput

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $to_name = $request->name;
        $to_email = $request->email;

        $body = "<a href=''>Cliquer ici</a> pour confirmer votre courriel";

        Mail::send('email.mail', ['name' => $to_name, 'body' => $body],
            function($message) use ($to_name, $to_email)
        {
          $message->to($to_email, $to_name)->subject('Courrier de test de Laravel ');
        });
        
        return redirect()->back()->withSuccess(trans('lang.text_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    public function userList(){
        $users = user::select('id','name','email')->paginate(5);
        return view('auth.user-list', ['users' => $users]);
    }

    public function authentication(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        if(!Auth::validate($credentials)):
            return redirect()->back()->withErrors(trans('auth.password'))->withInput();
        endif;
       
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
     
        Auth::login($user);
       
        return redirect()->intended(route('user.list'));

        // return  $credentials;
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email' => 'exists:users'
        ]);

        $user = User::where('email', $request->email)->first();

        $tempPassword = str::random(45);

        //return "new-password/$user->id/$tempPassword";
        $user->temp_password = $tempPassword ;
        $user->save();

        $to_name = $user->name;
        $to_email = $user->email;

        $body = "<a href='".route('new.password',[$user->id, $tempPassword])."'>cliquer ici pour changer le mot de passe</a>";

        Mail::send('email.mail', ['name' => $to_name, 'body' => $body],
            function($message) use ($to_name, $to_email)
        {
          $message->to($to_email, $to_name)->subject('Reset Password');
        });

        return redirect(route('login'))->withSuccess('Please check your email');

    }

    public function newPassword(User $user, $tempPassword){
        if($user->temp_password === $tempPassword){
            return view('auth.new-password');
        }
        return redirect(route('forgot.password'))->withErrors('Access denied');
    }

    public function storeNewPassword(Request $request, User $user, $tempPassword){
        if($user->temp_password === $tempPassword){
            $request->validate([
                'password' => 'max:20|min:6|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
            
            return redirect(route('login'))->withSuccess(trans('lang.text_success'));
        }
        
        return redirect(route('forgot.password'))->withErrors('Access denied');
    }

}