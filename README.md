## 描述
基于ThinkPHP3.2、jquery、bootstrap 开发的物流平台，实现管理员的RABC的权限管理。
拥有快递CURD操作、面单打印，扫码枪录入、快递状态查询等功能。

## 环境搭建
推荐使用WAMP集成工具进行搭建
数据库名为 haoxun_express，数据库的sql文件是目录下的
  haoxun_express.sql 文件
  
可在 Application/common/config 最上面配置

## jQ:
前后端动画
## Boostrap：
用于快速构建响应式系统，网站前后端均有使用
## Thinkphp：
对数据的操作，和用其模板引擎进行页面生成

## 用户账号
#### 后台超级管理员：
        用户名：123 密码：123123
#### 前端登录普通用户：
        用户名：13397003101 密码：123123

## 打印功能
面单打印功能需要在本地电脑上另安装附件：Lodop6.221_CLodop3.029.zip


## 备注：
    tp默认进入模块为前端，后台在system模块
    地图api和发送短信api需要域名认证，在测试环境无法使用