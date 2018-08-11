<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => '']);
    }
    public function index(Request $request){
        $user = $request->user();
        $userList=DB::table('users')->select('id','name','email','created_at')->get();
        //var_dump($userList);
        //return ;
        //echo $user['name'].'登录成功！';
        return view('admin.admin_user',['user'=>$user ,'userList'=>$userList]);
    }
    public function create(){
        return [
            'create'
        ];
    }

    public function store(Request $request){
        $user = new \App\User;
        $user->name=$request->data['name'];
        $user->email=$request->data['email'];
        $user->password= bcrypt($request->data['password']);
        if($user->save()){
            return ['code'=>0,'msg'=>'添加成功'];
        }else {
            return ['code'=>-1,'msg'=>'添加失败'];
        }


    }

    public function show($id){
        return \App\User::find($id);
    }
    public function edit($id){
        return [
            'edit'
        ];
    }
    public function update($id,Request $request){
        $user = \App\User::find($id);
        $input=array_filter($request->data);

        if(isset($input['password'])){
            $input['password']=bcrypt( $input['password']);
        }
        if($user->update($input)){
            return ['code'=>0,'msg'=>'修改成功'];
        }else {
            return ['code'=>-1,'msg'=>'修改失败'];
        }
    }
    public function destroy($id){
        if($id==1 || !\App\User::find($id)->delete())
            return ['code'=>-1,'msg'=>'删除失败'];
        else
            return ['code'=>0,'msg'=>'删除成功'];
    }

}
