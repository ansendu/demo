<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��21��
 * Time: 11:30
 */


class RedisObj
{

    /** @var object Redis */
    public $redis;

    public function __construct($host='127.0.0.1', $port=6379, $pwd='')
    {
        $this->redis = new Redis();
        $this->redis->connect($host, $port) or die ('connect redis failed');
        if ($pwd) {
            $this->redis->auth($pwd);
        }
    }

    /**
     * @param $key
     * @param $val
     * @return bool
     */
    public function setStr($key, $val)
    {
        return $this->redis->set($key, $val);
    }

    /**
     * @param $key
     * @return bool|string
     */
    public function getStr($key)
    {
        return $this->redis->get($key);
    }

    /**
     * @param $key
     * @return int
     */
    public function delStr($key)
    {
        return $this->redis->delete($key);
    }

    /**
     * �����б�
     * @param $key
     * @param $val
     * @return int
     */
    public function setList($key, $val)
    {
        $n = 0;
        $val = (array)$val;
        if (is_array($val)) {
            foreach ($val as $v) {
                $n += $this->redis->lPush($key, $v);
            }
        }
        return $n;
    }

    /**
     * ��ȡ�б�
     * @param $key
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getList($key, $start = 0, $end = 20)
    {
        return $this->redis->lRange($key, $start, $end);
    }

    /**
     * �б���
     * @param $key
     * @return int
     */
    public function listLen($key)
    {
        return $this->redis->lLen($key);
    }

    /**
     * @param string $pattern
     * @return array
     */
    public function getKeys($pattern = '*')
    {
        return $this->redis->keys($pattern);
    }

    /**
     * ��ȡָ������ֵ������������ڣ���Ӧ����false��ֻ���ַ�����������
     * @param $keys
     * @return array
     */
    public function getMultiple($keys)
    {
        return $this->redis->getMultiple($keys);
    }

    //region ��Ϣ����

    /**
     * @param $channel
     * @param $message
     */
    public function publish($channel,$message)
    {
       $this->redis->publish($channel,$message);
    }

    /**
     * @param $channel
     * @param $callback
     */
    public function subscribe($channel, $callback)
    {
        $this->redis->subscribe($channel,$callback);
    }

    //endregion ��Ϣ����

}

