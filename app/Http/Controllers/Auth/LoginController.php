<?php
/**
 * 功能：
 *
 * @project     larasite
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'mobile';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


}