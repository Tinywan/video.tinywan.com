<?php

/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: ShaoBo Wan (Tinywan)
 * |  Email: 756684177@qq.com
 * |  Date: 2019/11/3 17:34
 * |  Desc: 接口权限校验
 * '------------------------------------------------------------------------------------------------------------------*/

namespace app\http\middleware;

use Casbin\Exceptions\CasbinException;
use CasbinAdapter\Think\Facades\Casbin;
use think\facade\Log;

class AuthMiddleware
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @throws ForbiddenException
     * @throws \ReflectionException
     * @throws \think\Exception
     */
    public function handle($request, \Closure $next)
    {

        try {
            // 访问实体 sub, obj, act
            $uid = $request->header('uid'); // 数据库去查询，有没有这个人
            // 路由地址，访问资源
            $url = $request->baseUrl();
            // action GET
            $action = $request->method();
            if (empty($uid)) {
                return json(['code' => 401, 'message' => '身份为认证，你是假的吧！']);
            }
            Log::warning('[路由参数]：uid=' . $uid . ' url=' . $url . ' action=' . $action);
            if (!Casbin::enforce($uid, $url, $action)) {
                return json(['code' => 403, 'message' => '已认证，但没有权限访问']);
            }
        } catch (CasbinException $exception) {
            return json(['code' => 403, 'message' => '授权异常 ' . $exception->getMessage()]);
        }
        return $next($request);
    }
}
