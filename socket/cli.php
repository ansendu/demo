<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��24��
 * Time: 14:44
 */

if ($argv[1] == 'cli') {
    echo $argv[0];
    echo 'this is cli' , PHP_EOL;
} else {
    echo 'unknown <br>';
}


$sapi = php_sapi_name();
$isCli = $sapi == 'cli' ? true : false;

if ($isCli) {
    fwrite(STDOUT, 'Enter your name��');
    $name = trim(fgets(STDIN));
    fwrite(STDOUT, 'Hello '. $name);
} else {
    echo 'Run in cli mode';
}

