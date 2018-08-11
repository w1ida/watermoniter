<?php
namespace App\Http\Controllers\Admin;

use App\Area;
use App\User;
use App\Http\Controllers\Controller;
use App\Point;
use Illuminate\Http\Request;

class Page extends Controller
{
	public $user;
    public function __construct()
    {
        $this->middleware('auth',['except' => '']);
    }
    public function index(Request $request){
        $user = $request->user();
        //echo $user['name'].'登录成功！';
        $userCnt=User::All()->count();
        $areaCnt=Area::All()->count();
        $pointCnt=Point::All()->count();
        $areaList=Area::all(['aid','aname']);
        $pointlist=Point::whereRaw('1')->orderBy('pid')->get(['pid','pname','aid']);
        return view('admin.admin_index',['user'=>$user ,'userCnt'=>$userCnt,'areaCnt'=>$areaCnt,'pointCnt'=>$pointCnt,
            'areaList'=>$areaList,
            'pointlist'=>$pointlist,
            ]);
    }
	public function waterarea(Request $request){
        $user = $request->user();
        return view('admin.admin_waterarea',['user'=>$user ]);
    }
    public function map(Request $request){
        $user = $request->user();
        $points=\App\Point::has('area')->get(['aid','pname','pid','lng','lat']);
        //var_dump($points[0]->area);
        //return;
        return view('admin.admin_map',['user'=>$user,'points'=>$points ]);
    }
	public function syslog(Request $request){
        $user = $request->user();
        return view('admin.admin_syslog',['user'=>$user ]);
    }
	public function syssetting(Request $request){
        $user = $request->user();
        return view('admin.admin_syssetting',['user'=>$user ]);
    }
	
	public function monitorpoint(Request $request){
        $user = $request->user();
		$query=$request->query;
		$aid=$query->get('aid');
        return view('admin.admin_monitorpoint',['user'=>$user ])->with(['aid'=>$aid]);
    }
	
}
