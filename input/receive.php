<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��20��
 * Time: 14:56
 *
 * file_get_contents('php://input')ʹ�ð���1
 *
 */

include '../log.php';
error_reporting(E_ALL);

function get_contents() {
    $xmlstr= file_get_contents("php://input");
    $filename= './' . time().'.png';

//    log::w($xmlstr);

    if(file_put_contents($filename,$xmlstr)){
        echo 'success';
    }else{
        echo 'failed';
    }

}

$headers = getallheaders();
log::w($headers, 'w+');
get_contents();