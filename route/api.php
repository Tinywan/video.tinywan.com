<?php

/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |  Blog: http://www.cnblogs.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: Tinywan(ShaoBo Wan)
 * |  Date: 2019/9/8 11:48
 * |  Email: 756684177@qq.com
 * |  Desc: 描述信息
 * '------------------------------------------------------------------------------------------------------------------*/
// 工具类
use think\facade\Route;

Route::group('api', function () {
	// 项目管理
	Route::group('projects', function () {
		// 列表
		Route::get('', 'api/Project/getList');
		// 添加
		Route::post('', 'api/Project/add');
		// 更新
		Route::put(':id', 'api/Project/update');
		// 删除
		Route::delete(':id', 'api/Project/delete');
	});
});
