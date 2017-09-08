<?php

/**
 * ������
 * ���Զ���������ͳ�Ա����
 * �����й��췽��
 * ���Զ�����ͨ��Ա����
 * ������һ������������Ϊ���󷽷�
 * Class Father
 */
abstract class Father {

    public $val;

    /**
     * ���󷽷�
     * @return mixed
     */
    abstract function method1();

    /**
     * ���󷽷�
     * @return mixed
     */
    abstract function method2();

    /**
     * ��ͨ����
     */
    public function method3()
    {

    }
}

/**
 * Class Son
 */
class Son extends Father {
    public function method1()
    {
        echo 'one';
    }
    public function method2()
    {
        echo 'two';
    }
}

/**
 * �ӿ���
 * ���ܶ���������͵ĳ�Ա����
 * ���������ೣ��
 * ���еķ��������뱻ʵ��
 * ���еķ���Ĭ����public���ͣ�����ʹ��private��protected
 * �����й��췽��
 * һ�������ͬʱʵ�ֶ���ӿڣ���һ����ֻ�ܼ̳���һ��������
 * Interface IFather
 */
Interface IFather {
    const VAL = '123456';
    function method1();
    function method2();
}

/**
 * Class ISon
 */
class ISon implements IFather {
    public function method1()
    {
        echo 'one';
    }
    public function method2()
    {
        echo 'two';
    }
}