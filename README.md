
### 安装依赖库

composer 
```
compsoer install
```

Docker 容器使用 composer
```
docker run --rm --interactive --tty -v e:/dnmp/www/wiot.tinywan.com:/app composer install --ignore-platform-reqs
```
## 数据填充

```
php think seed:run
```
> 生成casbin测试案例数据

## 访问

http://video.wiot.tinywan.cn:8007/

## Casbin 学习记录

* 1、ThinkPHP5.1 + Casbin权限实战：入门分享
* [2、ThinkPHP5.1+Casbin权限实战：基于角色的RBAC授权](./RBAC.md)
* [3、ThinkPHP5.1+Casbin权限实战：RESTful及中间件使用](./REST_API_RBAC.md)
