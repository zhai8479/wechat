<?php

namespace App\Http\Controllers;

use EasyWeChat\Core\Http;
use Log;

class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            Log::info('wechat message',[$message]);
            $content = $message->Content;
            $userid = $message->FromUserName;
            if (mb_strlen($content) > 30) $content = mb_substr($content, 0, 30);
            $msgtype = $message->MsgType;
            if ($msgtype == 'text') {
                $data = [
                    'key' => 'f94c347a708f4b02a1099eefa058d6d7',
                    'info' => $content,
                    'userid' => $userid,
                ];
                $response = \Requests::post('http://www.tuling123.com/openapi/api', [], $data);
                if ($response->success) {
                    $daan =json_decode($response->body);
                    Log::info('$response',[$daan]);
                   if ($daan->code == 10000){
                       return $daan->text;
                   } else return '请求错误';
                }else return '接口访问失败';
            }else return '欢迎关注小乌云';
            });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}