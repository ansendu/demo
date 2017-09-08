<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��24��
 * Time: 11:06
 *
 * redisӦ�ó�����ʽ����
 */


$redis = new Redis();
$redis->connect('127.0.0.1');


//10�������۴������ó���2��
$res = $redis->zRangeByScore('user:12:comment',time()-10 ,time());
$count = count($redis->zRangeByScore('user:12:comment',time()-10 ,time()));
if ($count == 2) {
    echo '10��֮�ڲ�������2��'; exit;
} else {
    $redis->zAdd('user:12:comment', time(), $count);
}


//��¼�û�ϲ����Ʒ���� ��ʵ������mongo
$redis->zAdd('user:1000:product:like', time(), '3002');
$redis->zAdd('user:1000:product:like', time(), '3001');
$redis->zAdd('user:1000:product:like', time(), '3004');
$redis->zAdd('user:1000:product:like', time(), '3003');
//$redis->zDelete('user:1000:product:like',3003);
//Ĭ��ϲ��ʱ������������
$products = $redis->zRange('user:1000:product:like', 0, -1,true);
var_dump($products);
//��ϲ��ʱ�併������
$products = $redis->zRevRange('user:1000:product:like', 0, -1,true);
var_dump($products);

//�������б�ʵ��
$redis->lPush('user:1000:product:like', '3002');
$redis->lPush('user:1000:product:like', '3001');
$redis->lPush('user:1000:product:like', '3004');
$redis->lPush('user:1000:product:like', '3003');
$redis->lRange('user:1000:product:like', 0, -1);

//��������һ
$redis->hSet('user:1000:message:notice', 'system', 1);
$redis->hIncrBy('user:1000:message:notice', 'system', 1);
$redis->hSet('user:1000:message:notice', 'comment', 1);
$redis->hIncrBy('user:1000:message:notice', 'comment', 1);
$redis->hGetAll('user:1000:message:notice');
