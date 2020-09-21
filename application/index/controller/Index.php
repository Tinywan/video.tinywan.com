<?php

/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: ShaoBo Wan (Tinywan)
 * |  Email: 756684177@qq.com
 * |  DateTime: 2020/9/20 17:15
 * |  Desc: 描述信息
 * '------------------------------------------------------------------------------------------------------------------*/

namespace app\index\controller;

use think\Controller;
use CasbinAdapter\Think\Facades\Casbin;

class Index extends Controller
{
    public function index()
    {
        var_dump(Casbin::removePolicy('alice', 'data1', 'read'));
        echo "<hr/>";
        var_dump(Casbin::enforce('alice', 'data1', 'read')); // false
        var_dump(Casbin::enforce('alice', 'data2', 'read'));
        var_dump(Casbin::enforce('alice', 'data2', 'write'));
        echo "<hr/>";
        var_dump(Casbin::enforce('bob', 'data1', 'read'));
        var_dump(Casbin::enforce('bob', 'data2', 'write'));
        echo "<hr/>";
        var_dump(Casbin::enforce('bob', 'data2', 'read')); // false
    }
}
