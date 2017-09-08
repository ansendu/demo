<?php
/**
 *��ʱ��
 */
class Timer
{
    //�������ж�ʱ����
    public static $task = array();

    //��ʱ���
    public static $time = 1;

    /**
     *��������
     *@param $time int
     */
    public static function run($time = null)
    {
        if($time)
        {
            self::$time = $time;
        }
        self::installHandler();
        pcntl_alarm(1);
    }

    /**
     *ע���źŴ�����
     */
    public static function installHandler()
    {
        pcntl_signal(SIGALRM, array('Timer','signalHandler'));
    }

    /**
     *�źŴ�����
     */
    public static function signalHandler()
    {
        self::task();
        //һ���ź��¼�ִ����ɺ�,�ٴ�����һ��
        pcntl_alarm(self::$time);
    }

    /**
     *ִ�лص�
     */
    public static function task()
    {
        if(empty(self::$task))
        {//û������,����
            return ;
        }
        foreach(self::$task as $time => $arr)
        {
            $current = time();

            foreach($arr as $k => $job)
            {//����ÿһ������
                $func = $job['func'];    /*�ص�����*/
                $argv = $job['argv'];    /*�ص���������*/
                $interval = $job['interval'];    /*ʱ����*/
                $persist = $job['persist'];    /*�־û�*/

                if($current == $time)
                {//��ǰʱ����ִ������

                    //���ûص�����,�����ݲ���
                    call_user_func_array($func, $argv);

                    //ɾ��������
                    unset(self::$task[$time][$k]);
                }
                if($persist)
                {//������־û�,��д������,�ȴ��´λ���
                    self::$task[$current+$interval][] = $job;
                }
            }
            if(empty(self::$task[$time]))
            {
                unset(self::$task[$time]);
            }
        }
    }

    /**
     *�������
     */
    public static function add($interval, $func, $argv = array(), $persist = false)
    {
        if(is_null($interval))
        {
            return;
        }
        $time = time()+$interval;
        //д�붨ʱ����
        self::$task[$time][] = array('func'=>$func, 'argv'=>$argv, 'interval'=>$interval, 'persist'=>$persist);
    }

    /**
     *ɾ�����ж�ʱ������
     */
    public function dellAll()
    {
        self::$task = array();
    }
}