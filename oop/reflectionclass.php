<?php

/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��08��15��
 * Time: 10:19
 */
class Person
{
    /** @var string ���� */
    public $name;
    /** @var int ���� */
    public $age;
    /** @var object �༶���� */
    private $_class;

    public function __construct($name = '����', zcClass $class = null)
    {
        $this->name = $name;
        $this->_class = $class;
    }

    public function getName()
    {
        return 'My name is ' . $this->name;
    }
}

Class zcClass
{
    /**
     * @return string
     */
    public function getName()
    {
        return '��һ����';
    }
}

$class = new ReflectionClass('Person');

// ��ȡ�������Ժ��ĵ�ע��
$properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);
foreach ($properties as $property) {
    echo $property->getDocComment();
    echo PHP_EOL;
    echo $property->getName();
    echo PHP_EOL;
}

echo PHP_EOL;
echo PHP_EOL;

// ��ȡ���з���
$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
foreach ($methods as $method) {
    echo $method->getName();
    echo PHP_EOL;
}

echo PHP_EOL;
echo PHP_EOL;

// ʵ������
$instance = $class->newInstanceArgs(['����']);
echo $instance->getName();

echo PHP_EOL;
echo PHP_EOL;

// ִ�з���
$method = $class->getMethod('getName');
echo $method->invoke($instance);

echo PHP_EOL;
echo PHP_EOL;

// ������
$constructor = $class->getConstructor();
$params = $constructor->getParameters();
foreach ($params as $param) {
    if ($param->isDefaultValueAvailable()) {
        echo $param->getClass();
        echo $param->getDefaultValue();
        echo PHP_EOL;
    }
}