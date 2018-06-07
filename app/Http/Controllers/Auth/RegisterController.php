<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showResetForm()
    {
        return view('auth.reset');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $messages = [
            'mobile.unique' => '手机号码已被注册',
            'authcode.require' => '手机验证码不正确',
            'password.min' => '密码请不要少于6个字符'
        ];
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:12|unique:users',
            'authcode' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        return $this->create($request->all());
//        event(new Registered($user));
    }

    public function reset(Request $request)
    {
        $messages = [
            'mobile.exists' => '该手机号码尚未注册',
            'password.min' => '密码位数不能少于6位'
        ];
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:12|exists:users,mobile',
            'authcode' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        return $this->update($request->all());


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $cache = Cache::get($data['mobile']);
        if ($cache !== $data['authcode']) {
            return response()->json([
                'errors' => '手机验证码不正确，请检查后重新输入'
            ], 422);
        }
        User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        return response()->json(['message' => '注册成功，请进行登录']);
    }

    protected function update(array $data)
    {
        $cache = Cache::get($data['mobile']);
        if ($cache !== $data['authcode']) {
            return response()->json([
                'errors' => '手机验证码不正确，请检查后重新输入'
            ], 422);
        } else {
            User::where('mobile', $data['mobile'])->update([
                'password' => Hash::make($data['password'])
            ]);
            return response()->json(['message' => '密码已成功修改，请重新登录']);
        }

    }
}
