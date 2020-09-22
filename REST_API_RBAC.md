## 基于RESTful的中间件
### 1、RESTful 是什么？

RESTFUL是一种网络应用程序的设计风格和开发方式，基于HTTP，可以使用XML格式定义或JSON格式定义。RESTFUL适用于移动互联网厂商作为业务使能接口的场景，实现第三方OTT调用移动网络资源的功能，动作类型为新增、变更、删除所调用资源。

[维基百科](https://zh.wikipedia.org/wiki/%E8%A1%A8%E7%8E%B0%E5%B1%82%E7%8A%B6%E6%80%81%E8%BD%AC%E6%8D%A2)
[阮老师 RESTful API 设计指南](http://www.ruanyifeng.com/blog/2014/05/restful_api.html)

### 2、RESTful Model
[支持的Models](https://casbin.org/docs/zh-CN/supported-models)
（1）keymatch2 模型
[keymatch2_model 参考](https://github.com/casbin/casbin/blob/master/examples/keymatch2_model.conf)
```
[request_definition]
r = sub, obj, act

[policy_definition]
p = sub, obj, act

[policy_effect]
e = some(where (p.eft == allow))

[matchers]
m = r.sub == p.sub && keyMatch2(r.obj, p.obj) && r.act == p.act
```
> 为什么这里要选择 keyMatch2 而不是 keyMatch1？

（2）keyMatch 和 keyMatch2 的区别是啥？

[Matchers中的函数](https://casbin.org/docs/zh-CN/function)
* 1、[keyMatch 案例模型](https://github.com/casbin/casbin/blob/master/examples/keymatch_policy.csv)
* 2、[keyMatch2 案例模型](https://github.com/casbin/casbin/blob/master/examples/keymatch2_policy.csv)

（3）二者的区别
* （1）keyMatch：能够支持使用`*`匹配进行匹配匹配,eg：/api/projects/*
* （2）keyMatch2：能够支持`*`号匹配和`/:resource`的模式，eg：/api/projects/:id

小结：keyMatch2 更符合复杂的 RESTful 