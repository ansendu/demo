<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/25
 * Time: 23:16
 *
 * �쳣δ����ᷢ��һ�����صĴ���
 * 1��ʹ�� set_exception_handler() ����
 * 2��ʹ�� try catch
 */

//create function with an exception function
function checkNum($number)
{
    try {
        if ($number > 1) {
            throw new Exception('Value must be 1 or below');
        }
        echo "\r\n";
        echo '�׳��쳣���ǲ��ǻ������ִ����';
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//trigger exception
//checkNum(2);

//set_exception_handler custom handle exception
set_exception_handler(function($e){echo $e->getMessage();});
throw new Exception('set_exception_handler����');

