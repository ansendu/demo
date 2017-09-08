<?php

namespace utils;

/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��05��19��
 * Time: 17:07
 */

class FileUtil
{

    /**
     * ����Ŀ¼
     * @param string $dirName Ŀ¼��./dir1/dir2/dir3
     * @param int $mode Ȩ��
     * @param bool|true $recursive �Ƿ�ݹ鴴����Ŀ¼
     * @since 2017-05-19
     * @return bool
     */
    public static function mkdir($dirName, $mode = 0777, $recursive = true)
    {
        if (is_dir($dirName)) {
            return true;
        } else {
            return $dirName ? mkdir($dirName, $mode, $recursive) : false;
        }
    }
}