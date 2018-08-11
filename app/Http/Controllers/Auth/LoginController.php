<?php
/**
 * Created by PhpStorm.
 * User: dksx
 * Date: 2018/4/3
 * Time: 20:50
 */

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * 处理身份认证尝试.
     *
     * @return Response
     */
    protected $redirectTo = '/admin';
    
    public function username()
    {
        return 'name';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }

    public function showLoginForm()
    {
        return view('admin.admin_login');
    }
}