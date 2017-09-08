<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��04��07��
 * Time: 16:10
 */

?>

<script src="https://cdn.bootcss.com/socket.io/1.7.3/socket.io.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>-->
<script>

    if ('WebSocket' in window) {
        // ����websocketʵ��
        var socket = io.connect('ws://localhost:8080');

        // ����socket���Ӵ����¼�
        socket.onopen = function(event) {
            // ʹ�����ӷ�������
            socket.send('hello websocket');
        };

        // �������������ص�����
        socket.onmessage = function(event) {
            console.log("client has received a message", event);
        };

        // �ر�ʱ�򴥷�
        socket.onclose = function(event) {
            console.log("close websocket");
        };

        // ����ʱ����
        socket.onerror = function(event) {
            console.log("this is an error");
        };


    } else {
        alert('can not support websocket');
    }

</script>
