<?php

/**
 * ����ģʽ ��������ģʽ��
 * ˵��������������Ĺ��̷�װ������ͨ�����ݲ�ͬ�Ĳ�������ʵ������ͬ����
 * ���ӣ�YII�����������PHP��Ҫ���Ӷ�����ݿ�
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��06��14��
 * Time: 8:55
 */
class Factory
{
    /**
     * ���ݲ�ͬ�Ĳ���ʵ������ͬ�����ݿ���
     * @param $name
     * @return Mysql|null|Oracle
     */
    public static function instance($name)
    {
        switch ($name) {
            case 'mysql':
                return new Mysql();
            case 'oracle':
                return new Oracle();
            default:
                return null;
        }
    }
}

$db = Factory::instance('mysql');
echo $db->getDBName();

/**
 * Class DB
 */
abstract class DB
{
    abstract public function getDBName();
}

/**
 * Class Mysql
 */
class Mysql extends DB
{
    public function getDBName()
    {
        return 'Mysql';
    }
}

/**
 * Class Oracle
 */
class Oracle extends DB
{
    public function getDBName()
    {
        return 'Oracle';
    }
}