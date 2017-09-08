<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/25
 * Time: 22:36
 *
 * �ӳپ�̬��
 * �����������ͨ����ʹ��self���õ��˾�̬���Ի�̬����ʱ����ʱ��̬����������
 * ���Ѿ����󶨵����������������д����ľ�̬�������Ѿ����ܸı丸�ຯ���Ľ��
 * @link http://www.cnblogs.com/codeAB/p/5560631.html
 */

abstract class Object {

}

class Student extends Object {

    public static function create()
    {
        return new Student();
    }

}

class Teacher extends Object {

    public static function create()
    {
        return new Teacher();
    }

}

//���ڰ�student��teacher�е�create()�����ᵽ������
class Object2 {

    public static function create()
    {
        return new static();
    }

}

class Student2 extends Object2{

}

class Teacher2 extends Object2 {

}

/*************************** demo *********************************/
echo get_class(Student::create());
echo "\r\n";
echo get_class(Teacher::create());


/***************************** demo2 *****************************/
echo "\r\n";
echo get_class(Student2::create());
echo "\r\n";
echo get_class(Teacher2::create());



//��һ������
class ParentClass {
    public static function name()
    {
        return __CLASS__;
    }
    public static function test()
    {
        return self::name(); //��Ϊstatic::name() �Ϳ�����
    }
}

class ChildClass extends ParentClass {
    public static function name()
    {
        return __CLASS__;
    }
}

echo "\r\n";
echo ChildClass::test();