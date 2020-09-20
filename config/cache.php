<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

return [
    // 使用复合缓存类型
    'type' => 'complex',
    // 默认使用的文件缓存
    'default' => [
        'type'	=>	'file',
        // 全局缓存有效期（0为永久有效）
        'expire'=>  0,
        // 缓存前缀
        'prefix'=>  'resty',
        // 缓存目录
        'path'  =>  '../runtime/cache/',
    ],

    // Redis 缓存
    'redis' => [
        // 驱动方式
        'type' => 'redis',
        // 服务器地址
        'host' => 'dnmp-redis',
        // 端口号
        'port' => '6379',
        // 密码
        'password' => '123456',
        // 缓存前缀
        'prefix' => 'RESTY_CACHE:',
        // 缓存有效期 0表示永久缓存
        'expire' => 604800,
    ]
];
