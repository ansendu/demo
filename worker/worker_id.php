<?php

use Workerman\Worker;
use Workerman\Lib\Timer;
require_once '../workerman/Autoloader.php';

$worker = new Worker('tcp://0.0.0.0:8585');
$worker->count = 4;
$worker->onWorkerStart = function($worker)
{
    // ֻ��id���Ϊ0�Ľ��������ö�ʱ��������1��2��3�Ž��̲����ö�ʱ��
    if($worker->id === 0)
    {
        Timer::add(3, function(){
            $time = time();
            echo "4 worker processes, only 0 timer $time\n";
        });
    }
};
// ����worker
Worker::runAll();