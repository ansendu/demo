<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��23��
 * Time: 8:45
 *
 * ò��ֻ��IE����������ҪP3PЭ�飬�ȸ����һ�£�����Ҫ����P3P��Ҳ�ܿ���
 */

header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
setcookie("test", $_GET['id'], time()+3600, "/");
