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
        return $next($request);
    }
}
