<?php
use Swoole\WebSocket\Server;
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new Server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
  $message="欢迎用户".$frame->data."来到聊天室";
    $ws->push($frame->fd, $message);
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();
?>