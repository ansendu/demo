<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��27��
 * Time: 15:15
 */


pcntl_signal(SIGALRM, function () {
   echo 'hello world' . PHP_EOL;
});
pcntl_alarm(3);

echo 'begin' . PHP_EOL;
sleep(3);
pcntl_signal_dispatch();