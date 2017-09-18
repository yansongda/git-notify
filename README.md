<h1 align="center">😆Git Notify😆</h1>

<p align="center">
git 代码推送通知
</p>

在公司进行开发时，如何**优雅而又不尴尬**的让老板知道自己每天几点下班，好让老板加工资，这是一个问题。

现在应该基本每个公司用钉钉，而钉钉又有机器人可以自动推送，😆，git 可以使用 webhook，于是，就有了这样一个系统。

当然，根据 git 的 webhook 特性，**大家可以打开脑洞，随意实现有意思的功能**。

## 特性
1. 隐藏不需要关心的内部流程
2. 可以随意增加现有类库中没有的服务

## 支持的服务
### git 提供商
- gitee （码云）

### destinations
- dingtalk （钉钉）  
实现消息推送功能

## 安装
`composer require yansongda/git-notify`

## 使用方法

### git webhook
`http://your-domain/?from=gitee&to=dingtalk`

### 服务端
```php
<?php

require './vendor/autoload.php';

use Yansongda\Supports\Log;

// 可选。如果不配置，则日志保存在系统临时目录下
$config = [
    'log' => '/temp/GitNotify.log',
];
$notify = new Yansongda\GitNotify\GitNotify($config);

// 可选。gitee 可以设置 webhook 密码，防止 URL 被恶意请求
// $notify->from->password = '123456';

// 可选。可以随意设置发送模板与格式。这里用到闭包。
// $from 为 git 服务。
/* $notify->destination->setTemplate(function ($from) {
    $data['msgtype'] = 'hahaha';
    $data['text']['content'] = "姓名：" . $from->user_name .
                                "\n\before：" . $from->before .
                                "\n\nafter：" . $from->after .
                                "\n\n推送时间：" . date('Y-m-d H:i:s');

    return $data;
});*/

$notify->destination->gateway = 'https://oapi.dingtalk.com/robot/send?access_token=36c01ca8552fa8f9f6xxxxx';

$response = $notify->destination->apply();
Log::info('发送结果：', $response->getBody()->getContents());
```

## LICENSE
MIT
