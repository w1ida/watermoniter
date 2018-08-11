<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WaterArea extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => '']);
    }
    public function index(Request $request)
    {
        $user = $request->user();
        $waterareas = Area::all();
        return view('admin.admin_waterarea', ['waterareas' => $waterareas,'user' => $user]);
    }

    public function store(Request $request){
        $area = new \App\Area;
        $area ->aname=$request->data['aname'];
        $area ->remark=$request->data['remark'];
        if($area ->save()){
            return ['code'=>0,'msg'=>'添加成功'];
        }else {
            return ['code'=>-1,'msg'=>'添加失败'];
        }
    }

    public function show($id){
        return \App\Area::find($id);
    }

    public function update($id,Request $request){
        $area = \App\Area::find($id);
        $input=array_filter($request->data);
        if($area->update($input)){
            return ['code'=>0,'msg'=>'修改成功'];
        }else {
            return ['code'=>-1,'msg'=>'修改失败'];
        }
    }

    public function destroy($id){
        if(count(\App\Area::find($id)->points()->get())){
            return ['code'=>0,'msg'=>'该水域下面还有监测点，无法删除'];
        }
        if( !\App\Area::find($id)->delete())
            return ['code'=>-1,'msg'=>'删除失败'];
        else
            return ['code'=>0,'msg'=>'删除成功'];
    }
}
