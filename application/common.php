<?php

use AlibabaCloud\Client\AlibabaCloud;
use app\common\exception\ParameterException;
use app\common\model\PayOrderModel;
use think\facade\Config;
use think\facade\Request;
use Webmozart\Assert\Assert;

/**
 * +----------------------------------------------------------
 * @desc Ajax请求响应数据
 * +----------------------------------------------------------
 * @param int $code 状态码 0 为成功，其他为失败
 * +----------------------------------------------------------
 * @param string $msg 错误消息
 * +----------------------------------------------------------
 * @param array $data 消息体
 * +----------------------------------------------------------
 * @param int $http_code http 状态码
 * +----------------------------------------------------------
 * @param array $header 头部
 * +----------------------------------------------------------
 * @param boolean $is_object 是否是对象
 * +----------------------------------------------------------
 * @return \think\response\Json
 * +----------------------------------------------------------
 */
function response_json($code = 0, $msg = 'success', $data = [], $http_code = 200, $header = [], $is_object = true)
{
    if (empty($data) && $is_object) {
        $data = (object) $data;
    }
    $result = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    ];
    return json($result, $http_code, $header);
}
