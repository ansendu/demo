<?php

use Workerman\Worker;

require_once '../workerman/Autoloader.php';
$global_uid = 0;

$text_worker = new Worker('text://0.0.0.0:2347');
$text_worker->count = 1;

// �ͻ�������
$text_worker->onConnect = function ($connection) {
    global $global_uid;
    $connection->uid = ++$global_uid;
};

// �ͻ��˷�����Ϣ
$text_worker->onMessage = function ($connection, $data) {
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] said: $data");
    }
};

// �ͻ����뿪
$text_worker->onClose = function ($connection) {
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] has leave");
    }
};

Worker::runAll();

