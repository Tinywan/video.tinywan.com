<?php

/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: ShaoBo Wan (Tinywan)
 * |  Email: 756684177@qq.com
 * |  DateTime: 2020/9/20 17:15
 * |  Desc: Casbin 测试专用
 * '------------------------------------------------------------------------------------------------------------------*/

namespace app\api\controller;

use think\Controller;
use CasbinAdapter\Think\Facades\Casbin;

class Project extends Controller
{
    /**
     * 项目列表
     */
    public function getList()
    {
        $userName = $this->request->get('user_name');
        if (!$this->permissionCheck($userName)) {
            return json(['code' => 403, 'msg' => $userName . ' 无权限访问']);
        }
        return json(['code' => 200, 'msg' => $userName . ' 获取列表', 'data' => ['name' => $userName]]);
    }

    /**
     * 添加项目
     */
    public function add()
    {
        $userName = $this->request->get('user_name');
        if (!$this->permissionCheck($userName)) {
            return json(['code' => 403, 'msg' => $userName . ' 无权限访问']);
        }
        // 接收添加数据
        $data = $this->request->post();
        return json(['code' => 201, 'msg' => $userName . ' 添加新项目', 'data' => $data]);
    }

    /**
     * 更新
     */
    public function update($id)
    {
        $userName = $this->request->get('user_name');
        if (!$this->permissionCheck($userName)) {
            return json(['code' => 403, 'msg' => $userName . ' 无权限访问']);
        }
        // 接收更新数据
        $data = $this->request->put();
        return json(['code' => 200, 'msg' => $userName . ' 更新项目id ' . $id, 'data' => $data]);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        $userName = $this->request->get('user_name');
        if (!$this->permissionCheck($userName)) {
            return json(['code' => 403, 'msg' => $userName . ' 无权限访问']);
        }
        // 接收更新数据
        $data = $this->request->delete();
        return json(['code' => 204, 'msg' => $userName . ' 删除项目id ' . $id]);
    }

    /**
     * 检查权限
     */
    public function permissionCheck($userName)
    {
        $url = $this->request->baseUrl();
        $action = $this->request->method();
        // 
        $authCheck = Casbin::enforce($userName, $url, $action);
        if ($authCheck) return true;
        return false;
    }
}
