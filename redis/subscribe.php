<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��21��
 * Time: 14:12
 */

// ��Ϣ����
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$message='�������';
$ret=$redis->publish('����㲥��̨',$message);
