<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��20��
 * Time: 14:55
 *
 * file_get_contents('php://input')ʹ�ð���2
 *
 */

$data = file_get_contents('./test.png');
$http_entity_body = $data;
//$http_entity_type = 'application/x-www-form-urlencoded';
$http_entity_type = 'multipart/form-data'; //�������ԣ�entityType����Ϊmultipart/form-dataʱ��Ҳ������php://input
$http_entity_length = strlen($http_entity_body);
$host = 'wuzhc.cm';
$port = 80;
$path = '/test/input/receive.php';
$fp = fsockopen($host, $port, $error_no, $error_desc, 30);
if ($fp) {
    fputs($fp, "POST {$path} HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-Type: {$http_entity_type}\r\n");
    fputs($fp, "Content-Length: {$http_entity_length}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $http_entity_body . "\r\n\r\n");
    while (!feof($fp)) {
        $d .= fgets($fp, 4096);
    }
    fclose($fp);
    echo $d;

}