<?php

/**
 * ����ģʽ����Ϊ��ģʽ��
 * ��һ���㷨���з�װ������˵������һ�������ж�����������ԣ����������ģʽ���ǽ��������
 * �ֱ��װ��һ���࣬���̳�һ�������ĳ������
 *
 * ��ɫ��
 * ��������ࣺ������ʵ�ֳ�����������ʵ�ַ���
 * ������һ������Ĳ���ҵ��
 * �������������Ĳ���ҵ��
 * �ͻ��ˣ����þ���Ĳ���
 *
 * @author wuzhc2016@163.com
 */

/**
 * ������Ի���
 * Class Strategy
 */
abstract class Strategy
{
    abstract public function doSomething();
}

/**
 * �������һ
 * Class StrategyOne
 */
class StrategyOne extends Strategy
{
    public function doSomething()
    {
        return 'bus';
    }
}

/**
 * ������Զ�
 * Class StrategyTwo
 */
class StrategyTwo extends Strategy
{
    public function doSomething()
    {
        return 'plane';
    }
}

/**
 * �ͻ���
 * Class User
 */
class Client
{
    private $_tool;

    public function __construct(Strategy $tool)
    {
        $this->_tool = $tool;
    }

    public function run()
    {
        echo 'I choose the ' . $this->_tool->doSomething();
    }
}


//------------ test --------------

$func = function (Strategy $strategy) {
    $client = new Client($strategy);
    $client->run();
    echo PHP_EOL;
};

$func(new StrategyOne());
$func(new StrategyTwo());
