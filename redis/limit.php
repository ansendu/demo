<?php
/**
 * �ֻ���֤��
 * ����һ������ֻ�ܷ���5��
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$key = 'p:limit:14718070574';
$isExist = $redis->set($key, 1, array('nx', 'ex' => 60));
if ($isExist === true || $redis->incr($key) <= 5) {
    printf('��%d�η����ֻ���֤��', $redis->get($key));
} else {
    echo 'һ������ֻ�ܷ���5��';
}