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

/**
 * 首页
 */
Route::group('h',function (){
	// 标签
	Route::get('tid/:tid', 'index/Index/index');
	// 文章详情
	Route::get('_ad/id/:id', 'index/Index/detail');

	// 公告详情
	Route::get('_nd/id/:id', 'index/Index/noticeDetail');

	// 直播详情
	Route::get('live', 'index/Index/live');

	// 支付demo
	Route::get('pay', 'index/Index/payDemo');
	Route::get('login', 'index/Index/login');

	// 退出
	Route::rule('logout', 'index/Index/logout');
	Route::rule('user', 'index/Index/user');

	Route::rule('pay_order', 'index/Index/payOrder');
	Route::rule('live', 'index/Index/live');
	Route::rule('liveDetail', 'index/Index/liveDetail');

	// 视频课程
	Route::rule('video', 'index/Index/video');
	// 视频课程介绍
	Route::rule('video-detail/:id', 'index/Index/videoDetail');
	// 视频课程详情
	Route::rule('video-watch/:id', 'index/Index/videoWatch');

	// 点播
	Route::rule('vod', 'index/Index/vod');
	Route::rule('vodDetail', 'index/Index/vodDetail');
});

/**
 * 工具类
 */
Route::group('tools',function (){
	// 获取游戏二维码
	Route::get('getGameQrCode', 'index/Tools/getGameQrCode');

	// 微信绑定
	Route::rule('wechatBind', 'index/Tools/wechatBind');
	// 微信授权回调
	Route::rule('wechatOAuthCallback', 'index/Tools/wechatOAuthCallback');
	// 微信游戏入口路由
	Route::get('wechatGameEntrance/create_id/:create_id', 'index/Tools/wechatGameEntrance');

	Route::post('bindGameClientId', 'index/Tools/bindGameClientId');

	// tinymceUpload 上传文件
	Route::post('tinymceUpload', 'index/Tools/tinymceUpload');
	// Ajax发送消息
	Route::post('ajaxClientMessage', 'index/Tools/ajaxClientMessage');
})->allowCrossDomain();
