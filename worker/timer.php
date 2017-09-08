<?php

use Workerman\Worker;
use Workerman\Lib\Timer;

require_once '../workerman/Autoloader.php';

$worker = new Worker(); // �����������ڶ�ʱ����
$worker->onWorkerStart = function ($task) {
    $time_interval = 3;
    Timer::add($time_interval, function () {
        echo 'task run' . time() . PHP_EOL;
    });
};

Worker::runAll();