<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $messages = [
            'mobile.required' => '输入手机号码',
            'mobile.exists' => '该手机号尚未注册，您可以用它注册成为新用户',
            'password.min' => '密码请不要少于6个字符'
        ];
        $validator = Validator::make($request->all(), [
            'mobile' => [
                'required',
                Rule::exists('users')->where(function ($q) {
                    $q->where('mobile', request()->input('mobile'));
                })
            ],
            'password' => 'required|string|min:6',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        $credentials = request(['mobile', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['errors' => '手机或密码输入不正确，请重试'], 422);
        }

        return $this->respondWithToken($token);
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => '成功退出系统']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(Request $request)
    {
        $messages = [
            'mobile.unique' => '该手机号码已被注册，无需重复注册',
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

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function create(array $data)
    {
        $cache = Cache::get($data['mobile']);
        if ($cache !== $data['authcode']) {
            return response()->json([
                'errors' => '手机验证码不正确，请检查后重新输入'
            ], 422);
        }
        $this->user->create([
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
        return response()->json([
            'message' => '注册成功，请进行登录',

        ]);
    }

    protected function update(array $data)
    {
        $cache = Cache::get($data['mobile']);
        if ($cache !== $data['authcode']) {
            return response()->json([
                'errors' => '手机验证码不正确，请检查后重新输入'
            ], 422);
        } else {
            $this->user
                ->where('mobile', '=', $data['mobile'])
                ->update([
                    'password' => bcrypt($data['password'])
                ]);
            return response()->json(['message' => '密码已成功修改，请重新登录']);
        }

    }
}
