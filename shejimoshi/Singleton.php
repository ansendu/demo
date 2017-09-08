<?php

/**
 * ����ģʽ ��������ģʽ��
 * ˵����ȷ��ĳ����ֻ��һ��ʵ��������������ϵͳȫ�ֵ��ṩ���ʵ��
 * ���ӣ�PHP�����ݿ�Ľ���������������Ϣ
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��06��14��
 * Time: 9:15
 */
class Singleton
{

    /**
     * @var Singleton �������ʵ��
     */
    private static $_instance;

    /**
     * ����Ϊprivate,��ֹ�ⲿʵ��������
     */
    private function __construct()
    {
        echo "This is a Constructed method;";
    }

    /**
     * ��ֹ���󱻿�¡
     */
    public function __clone()
    {
        trigger_error('Clone is not allow !', E_USER_ERROR);
    }

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * test method
     */
    public function test()
    {
        echo '���÷����ɹ�';
    }
}

// ��ȷ�ĵ��÷���
$singleton = Singleton::getInstance();
$singleton->test();

// ��ͼclone����ʱ���ᴥ��һ������
$singleton_clone = clone $singleton;
