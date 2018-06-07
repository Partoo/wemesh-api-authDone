<?php
/**
 * 功能：
 *
 * @project     larasite
 * @typeor      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Services\Sms;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * 短信发送控制器
     * 以GET方法获取，格式为 api/v1/getSms?mobile=18669783161&content=type&type=reset
     * type默认为null，用在以下场景中：
     * 大部分情况下都是要验证手机号码需要存在的，只是在注册时需要验证该手机号码不存在
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed|\Symfony\Component\HttpFoundation\ParameterBag
     */
    public function fire(Request $request)

    {
//        注册时获取验证码，该手机号不能存在
//        重置密码或者其它场景下获取验证码，该手机号必须已存在
        $type = $request->input('type');
        $mobile = $request->input('mobile');

        if ($type !== 'null') {
            if (User::where('mobile', '=', $mobile)->exists()) {
                return response()->json(['errors' => '手机号码已注册，请直接登录'], 422);
            }
        } else {
            if (!User::where('mobile', '=', $mobile)->exists()) {
                return response()->json(['errors' => '手机号码不存在，无法使用该功能'], 422);
            }
        }
        return (new SmsClient)->to($mobile)->content('auth')->send();
    }
}