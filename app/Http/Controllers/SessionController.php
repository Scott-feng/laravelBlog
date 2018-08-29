<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //

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
                session()->flash('danger','你的账号未激活，请检查邮箱中的注册邮件激活');
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
}
