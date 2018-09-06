<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Mail;
use Auth;
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

    //获取所有用户
    public function index(){
        //auth

        $users=User::paginate(10);
        return view('admins.admin-list',compact('users'));
    }

    public function destroy(User $user){

        $user->delete();
        return response()->json(['status'=>0,'msg'=>'删除成功']);
    }

    public function destroyAll(Request $request){

        //json format from ajax send
        $user_list=$request->user_list;
//
        $num_list=[];
        //json 格式转为数组
        foreach (json_decode($user_list) as $item){
            array_push($num_list,(int)$item);
        }

        if(User::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除失败']);


    }

    public function display(User $user){
        return view('admins.admin-edit',compact('user'));
    }

    public function modify(Request $request,User $user){
        $is_admin = $request->is_admin;

        $user = User::findOrFail($user->id);

        $user->is_admin = $is_admin;
        $user->save();

        return response()->json(['status'=>0,'msg'=>'更新权限成功']);

    }




}
