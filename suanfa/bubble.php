<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��24��
 * Time: 14:29
 *
 * ð�������㷨
 */

$arr = array(45, 78, 23, 78, 6, 4, 87, 87, 54, 56, 3, 4, 5, 64, 3, 1, 546, 89);
echo implode(' < ', $arr);
echo PHP_EOL;

$total = count($arr);
for ($i = 0; $i < $total - 1; $i++) {
    for ($j = $total - 1; $j > $i; $j--) {
        if ($arr[$j - 1] > $arr[$j]) {
            $temp = $arr[$j - 1];
            $arr[$j - 1] = $arr[$j];
            $arr[$j] = $temp;
        }
    }
}

echo implode(' < ', $arr);

