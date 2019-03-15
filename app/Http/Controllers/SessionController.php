<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;
use Auth;
class SessionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create','github','githubCallback']
        ]);
    }


    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
           'email' => 'required|email|max:255',
           'password' => 'required',
        ]);

        if (Auth::attempt($credentials,$request->has('remember'))){
            if (Auth::user()->activated){
                session()->flash('success','欢迎回来');
                return redirect()->route('users.show',[Auth::user()]);
            } else {
                Auth::logout();
                return session()->flash('danger','你的账号未激活，请检查邮箱中的注册邮件激活');
                redirect('/');
            }

        } else {
            session()->flash('danger','您的邮箱和密码不匹配');
            return redirect()->back();
        }

    }

    public function destroy(){
        Auth::logout();
        session()->flash('message','您已登出');
        return redirect('login');
    }

    public function github(){
        $socialite = new SocialiteManager(config('services'));

        $response = $socialite->driver('github')->redirect();
        return $response;
    }

    public function githubCallback(){
        $socialite = new SocialiteManager(config('services'));

        $user = $socialite->driver('github')->user();

        //dd($user);
        //未注册用户
        if (!$newUser = User::where('email',$user->getEmail())->first()){
            $new = User::create([
                'name' => $user->getNickname(),
                'email' => $user->getEmail(),
                'password' => bcrypt(str_random(8)),
                'avatar' => $user->getAvatar(),


            ]);
            Auth::login($new);
        }
        //dd($newUser);

        //已注册未登录的用户
        if (!Auth::check()){
            Auth::login($newUser);
        }

        return redirect('/');
    }

}
