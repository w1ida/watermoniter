<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use Illuminate\Http\Request;
use App\Point;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MonitorPoint extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => '']);
    }

    public function index(Request $request)
    {
        //filter
        $user = $request->user();
        $waterareas = Area::All(['aid','aname']);
        $points=Point::All();
        if(isset($request->aids)){
            $aidarr=json_decode( $request->aids,true);
            $points=$points->whereIn('aid',$aidarr);
        }
        return view('admin.admin_monitorpoint', ['waterareas' => $waterareas,'points'=>$points,'user' => $user]);
    }

    public function store(Request $request){
        $point = new \App\Point;
        $point ->pname=$request->data['pname'];
        $point ->aid=$request->data['aid'];
        $point ->lng=$request->data['lng'];
        $point ->lat=$request->data['lat'];
        if($point ->save()){
            return ['code'=>0,'msg'=>'添加成功'];
        }else {
            return ['code'=>-1,'msg'=>'添加失败'];
        }
    }

    public function show($id){
        return \App\Point::find($id);
    }

    public function update($id,Request $request){
        $point = \App\Point::find($id);
        $input=array_filter($request->data);
        if($point->update($input)){
            return ['code'=>0,'msg'=>'修改成功'];
        }else {
            return ['code'=>-1,'msg'=>'修改失败'];
        }
    }

    public function destroy($id){
        if(!\App\Point::find($id)->delete())
            return ['code'=>-1,'msg'=>'删除失败'];
        else
            return ['code'=>0,'msg'=>'删除成功'];
    }
}
