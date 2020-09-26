## RESTful及中间件使用（脚本）
### 1、RESTful 是什么？

RESTFUL是一种网络应用程序的设计风格和开发方式，基于HTTP，可以使用XML格式定义或JSON格式定义。RESTFUL适用于移动互联网厂商作为业务使能接口的场景，实现第三方OTT调用移动网络资源的功能，动作类型为新增、变更、删除所调用资源。

建议阅读

1. [维基百科](https://zh.wikipedia.org/wiki/%E8%A1%A8%E7%8E%B0%E5%B1%82%E7%8A%B6%E6%80%81%E8%BD%AC%E6%8D%A2)

2. [阮老师 RESTful API 设计指南](http://www.ruanyifeng.com/blog/2014/05/restful_api.html)

### 2、RESTful Model

（1）keymatch2 模型

1. [支持的Models](https://casbin.org/docs/zh-CN/supported-models)
2. [Golang Models的源码](https://github.com/casbin/casbin/blob/master/util/builtin_operators_test.go)

```php
[request_definition]
r = sub, obj, act

[policy_definition]
p = sub, obj, act

[policy_effect]
e = some(where (p.eft == allow))

[matchers]
m = r.sub == p.sub && keyMatch2(r.obj, p.obj) && regexMatch(r.act, p.act)
```
> 为什么这里要选择 keyMatch2 而不是 keyMatch1？

（2）keyMatch 和 keyMatch2 的区别是啥？

[Matchers中的函数](https://casbin.org/docs/zh-CN/function)
* 1、[keyMatch 案例模型](https://github.com/casbin/casbin/blob/master/examples/keymatch_policy.csv)
* 2、[keyMatch2 案例模型](https://github.com/casbin/casbin/blob/master/examples/keymatch2_policy.csv)

（3）二者的区别
* （1）keyMatch：能够支持使用`*`匹配进行匹配匹配,eg：/api/projects/*
* **（2）keyMatch2：能够支持`*`号匹配和`/:resource`的模式，eg：/api/projects/:id**

小结：keyMatch2 更符合复杂的 RESTful 

### 3、Postman 测试

**（1）测试说明**

通过用户名（user_id）请求casbin定义的策略是否有权限访问

1. 获取项目：`/api/projects` GET 方式
2. 创建新项目：`/api/projects` POST 方式
3. 删除项目：`/api/projects/2020` DELETE 方式

**（2）定义路由地址**

```php
Route::group('api', function () {
	// 项目管理
	Route::group('projects', function () {
		// 列表
		Route::get('', 'api/Project/getList');
		// 添加
		Route::post('', 'api/Project/add');
		// 删除
		Route::delete(':id', 'api/Project/delete');
	});
})->allowCrossDomain();
```

（3）添加测试数据

```sql
INSERT INTO `casbin_rule` VALUES (1, 'p', 'Tinywan', '/api/projects', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` VALUES (2, 'p', 'Tinywan', '/api/projects', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` VALUES (3, 'p', 'Tinywan', '/api/projects/:id', 'DELETE', NULL, NULL, NULL);
```

（4）开始测试

### 4、中间件使用

路由添加中间件
```php
Route::group('api', function () {
	// 项目管理
	Route::group('projects', function () {
		// 列表
		Route::get('', 'api/Project/getList');
		// 添加
		Route::post('', 'api/Project/add');
		// 删除
		Route::delete(':id', 'api/Project/delete');
	});
})->middleware(AuthMiddleware::class)->allowCrossDomain();
```

中间件参考代码
```php
$url = $request->baseUrl();
try {
    $action = $request->method();
    $uid = $request->header('uid');
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
```

请求日志
```php
[ warning ] [路由参数]：uid=Tinywan url=/api/projects action=GET
```