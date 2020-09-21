# video.tinywan.com
video.tinywan.com


### Composer 安装依赖库

```
compsoer install
```

Docker 容器
```
docker run --rm --interactive --tty -v e:/dnmp/www/wiot.tinywan.com:/app composer install --ignore-platform-reqs
```

## （2020-09-21）课程脚本.

> 2、ThinkPHP5.1 + Casbin权限实战：身份验证和基于角色的RBAC授权

### 1、上一个视频的录制回顾
* 有同学反馈，声音比较小  
* 有些环节比较乱，不懂（课程是大家对于身份认证和访问授权没有区分开）  

### 2、HTTP API 身份验证和授权

 [HTTP API 身份验证和授权](https://cloud.tencent.com/developer/article/1695510) 本文分享自微信公众号 - 万少波的播客（Tinywanblog）

### 3、官方-Model语法
* [官方-Model语法](https://casbin.org/docs/zh-CN/syntax-for-models)
* 仔细研究一下官方的model语法 
* 需要注意的事项 

### 4、官方-基于角色的访问控制
[官方-基于角色的访问控制](https://casbin.org/docs/zh-CN/rbac)
### 5、RBAC是什么？
[RBAC是什么？](https://www.cnblogs.com/niuli1987/p/9871182.html)
### 6、官方-RBAC模型
[官方-RBAC模型编辑器](https://casbin.org/zh-CN/editor)

#### Model 定义
```javascript
[request_definition]
r = sub, obj, act

[policy_definition]
p = sub, obj, act

[role_definition]
g = _, _

[policy_effect]
e = some(where (p.eft == allow))

[matchers]
m = g(r.sub, p.sub) && r.obj == p.obj && r.act == p.act
```

#### Policy 定义
```javascript
p, alice, data1, read
p, bob, data2, write
p, data2_admin, data2, read
p, data2_admin, data2, write

g, alice, data2_admin
```
> 1、两个用户 alice 和 bob
> 2、一个角色 data2_admin
> 3、用户 alice 继承 data2_admin 

#### Request （请求验证权限）
```javascript
alice, data2, read
```

##### Enforcement Result （验证结果）
```javascript
true
```

### 6、代码实战

1、添加策略
```javascript
$enforcer->addPermissionForUser('alice', 'data1', 'read');
$enforcer->addPermissionForUser('bob', 'data2', 'write');
```

2、给 data2_admin 角色分配权限
```javascript
$enforcer->addPermissionForUser('data2_admin', 'data2', 'read');
$enforcer->addPermissionForUser('data2_admin', 'data2', 'write');
```

3、给 alice 分配角色 data2_admin
```javascript
$enforcer->addRoleForUser('alice', 'data2_admin'); 
```
> alice 将会拥有的所有 data2_admin 权限

4、分配完角色和权限后，数据库中的策略规则大致如下：（查看数据）

```javascript
p, alice, data1, read
p, bob, data2, write
p, data2_admin, data2, read
p, data2_admin, data2, write

g, alice, data2_admin
```

5、验证权限
alice 具有data2_admin 角色，继承data2_admin角色的全部权限.
```
$enforcer->enforce('alice', '/foo', 'GET'); // true
$enforcer->enforce('alice', '/foo', 'GET'); // true
$enforcer->enforce('alice', '/foo', 'POST'); // true
$enforcer->enforce('alice', '/foo/1', 'PUT'); // true
$enforcer->enforce('alice', '/foo/1', 'DELETE'); // true
```
