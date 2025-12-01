# 项目介绍

## 基础环境

* laravel10.x
* php8.2 及以上
* mysql5.7 or 10.4.32-MariaDB

## 插件

* laravel/breeze 2.3.8
* kra8/laravel-snowflake 2.4.1
* mk-j/php_xlsxwriter 0.39

## 运行环境(参考)

## 当前功能简介


### 1. 登录注册
* 基于breeze官方套件实现

### 2. 开发工具
* DEV模块 使用 权限过滤中间件
* /dev 页面支持查询、展示、导出
> 对接口设置访问频次限制

> /query/list 通用查询，通过后端配置 过滤敏感表

> /query/export 通用导出 支持 Excel、JSON

## 后续计划

1. API接口调用 

## 部署过程

### 环境准备

* node 24.11.1
* npm 11.6.2
* php8.2 及以上
* mysql5.7 or 10.4.32-MariaDB
* 把数据文件 ./laravel10Demo/database/laravex.sql 导入数据库

### 初始化项目

* 为laravelx数据库 创建数据库用户 laravelx 和安全的密码
```shell
cd laravel10Demo
composer install
```

* 修改.env文件中的数据库配置 
```editorconfig
DB_USERNAME=laravelx
DB_PASSWORD=password
```

### 前端服务启动
```shell
npm install
npm run dev
```

### 后端服务启动
```tips
在另一个terminal中执行
```

```shell
php artisan serve
```

# License

[CC-BY-NC-ND-4.0 中文版](https://creativecommons.org/licenses/by-nc-nd/4.0/legalcode.zh-Hans)

[CC-BY-NC-ND-4.0](https://creativecommons.org/licenses/by-nc-nd/4.0/legalcode)
