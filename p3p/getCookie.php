<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��23��
 * Time: 8:45
 */

setcookie('test',"",time()-3600,'/');
var_dump($_COOKIE);