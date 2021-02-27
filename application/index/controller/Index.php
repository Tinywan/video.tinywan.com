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
    /**
     * 入门案例
     *
     * @return void
     */
    public function index()
    {
        // var_dump(Casbin::removePolicy('alice', 'data1', 'read'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('alice', 'data1', 'read')); // false
        // var_dump(Casbin::enforce('alice', 'data2', 'read'));
        // var_dump(Casbin::enforce('alice', 'data2', 'write'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('bob', 'data1', 'read'));
        // var_dump(Casbin::enforce('bob', 'data2', 'write'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('bob', 'data2', 'read')); // false

        //=====================
        // var_dump(Casbin::enforce('tinywan2', '/api/user', 'GET'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('tinywan2', '/api/user', 'POST'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('tinywan2', '/api/user', 'PUT'));
        // echo "<hr/>";
        // var_dump(Casbin::enforce('tinywan2', '/api/user', 'DELETE'));

var_dump(Casbin::enforce('tinywan1', 'doamin1','/api/user', 'GET')); // true
echo "<hr/>";
var_dump(Casbin::enforce('tinywan1', 'doamin2','/api/user', 'POST')); // false
echo "<hr/>";
var_dump(Casbin::enforce('tinywan2', 'doamin1','/api/user', 'GET')); // false
echo "<hr/>";
var_dump(Casbin::enforce('tinywan2', 'doamin2','/api/user', 'POST')); // true
    }

    /**
     * Rbac 测试案例
     *
     * @return void
     */
    public function rbac()
    {
        // 1、添加策略
        // var_dump(Casbin::addPermissionForUser('alice', 'data1', 'read'));
        // var_dump(Casbin::addPermissionForUser('bob', 'data2', 'write'));

        // 2、给 data2_admin 角色分配权限
        // var_dump(Casbin::addPermissionForUser('data2_admin', 'data2', 'read'));
        // var_dump(Casbin::addPermissionForUser('data2_admin', 'data2', 'write'));

        // 3、给 alice 分配角色 data2_admin
        // var_dump(Casbin::addRoleForUser('alice', 'data2_admin')); 

        // 4、验证权限 ，alice 继承 data2_admin 。data2_admin 又是有 data2 read
        var_dump(Casbin::enforce('alice', 'data1', 'read'));
        $adminMap = ['admin1', 'admin2'];
    }

    function isSuperAdmin(array $adminMap, string $userName): bool
    {
        foreach ($adminMap as $admin) {
            if ($admin == $userName) {
                return true;
            }
        }
        return false;
    }
}
