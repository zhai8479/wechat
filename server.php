<?php
include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件
use EasyWeChat\Foundation\Application;
$options = [
    'debug'  => true,
    'app_id' => 'wxde2f745ed82213c6',
    'secret' => '474ed9fa465d49c7935c94c7fbaddf08',
    'token'  => 'zhai',
     'aes_key' => '6fGnKb24X5kxilma6YczQAwGjrF5zzP1CiqEp9E8E37',
    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
    ],
    //...
];
$app = new Application($options);
$response = $app->server->serve();
// 将响应输出
return $app->server->serve();
