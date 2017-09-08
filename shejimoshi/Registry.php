<?php

/**
 * ע����ģʽ��һ����������ģʽ��
 * �Ѷ���ʵ��ע�ᵽһ��ȫ�ֵĶ��󼯺��ϣ�������������ȫ�ֱ����Ľ�ɫ
 *
 * @author wuzhc2016@163.com
 */
class Registry
{
    private static $_objects = [];

    /**
     * @param $alias
     * @param $object
     */
    public static function add($alias, $object)
    {
        self::$_objects[$alias] = $object;
    }

    /**
     * @param $alias
     */
    public static function remove($alias)
    {
        if (isset(self::$_objects[$alias])) {
            unset(self::$_objects[$alias]);
        }
    }

    /**
     * @param $alias
     * @return null
     */
    public static function get($alias)
    {
        return isset(self::$_objects[$alias])
            ? self::$_objects[$alias] : null;
    }
}


//------------- test -----------

class App
{
    public function run()
    {
        echo 'this is an app';
    }
}

Registry::add('app', new App());
/** @var App $app */
$app = Registry::get('app');
$app->run();