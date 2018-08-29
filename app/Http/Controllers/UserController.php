<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['show','create','store','confirmEmail']
        ]);

        $this->middleware('guest',[
           'only'=>['create']
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request){
        $this->validate($request,[
           'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password),
        ]);

//        Auth::login($user);
        $this->sendEmailConfirmationTo($user);
        session()->flash('message','验证邮件已经发送，请检查邮箱');
        return redirect('/');
    }

    public function confirmEmail($token){
        $user=User::where('activation_token',$token)->firstOrFail();

        $user->activated=true;
        $user->activation_token=null;
        $user->save();

        Auth::login($user);
        session()->flash('success','恭喜您，激活成功');
        return redirect()->route('users.show',[$user]);
    }

    public function show(User $user)
    {

        return view('users.show',compact('user'));
    }

    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user,ImageUploadHandler $uploader){
        $this->authorize('update',$user);
        $data = $request->all();
        if ($request->avatar){
            $result = $uploader->save($request->avatar,'avatars',$user->id,360);
            if ($result){
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show',[$user])->with('success','更新个人信息成功');
    }

    protected function sendEmailConfirmationTo($user){
        $view='emails.confirm';
        $data=compact('user');
        $from='aufree@yoursails.com';
        $name='Aufree';
        $to=$user->email;
        $subject="感谢您注册SCOTT BLOG.请确认您的邮箱";

        Mail::send($view,$data,function ($message) use($from,$name,$to,$subject){
            $message->from($from,$name)->to($to)->subject($subject);
        });
    }
}
