<?php
use Swoole\WebSocket\Server;
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new Server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
   
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    // var_dump($frame);
    $info = json_decode($frame->data,true);
    if($info['type']=='login'){
        $message=[
            'is_me'=>1,
            'username'=>$info['con']
        ];
        $res=json_decode($message);
        $ws->push($frame->fd, $res);
    }
 
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();
?>