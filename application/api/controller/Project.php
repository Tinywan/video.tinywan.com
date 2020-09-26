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

class Project extends Controller
{
    /**
     * 项目列表
     */
    public function getList()
    {
        return json(['code' => 200, 'msg' => ' 获取列表']);
    }

    /**
     * 创建项目
     */
    public function add()
    {
        $data = $this->request->post();
        return json(['code' => 201, 'msg' => ' 添加新项目', 'data' => $data]);
    }

    /**
     * 删除
     */
    public function delete($id)
    {
        return json(['code' => 204, 'msg' => ' 删除项目id ' . $id]);
    }
}
