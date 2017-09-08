<?php

ini_set('session.gc_maxlifetime', 10);

class Session_custom {
    /** @var  Redis */
    private $redis; // redisʵ��
    private $prefix = 'sess_'; // session_idǰ׺

    // �Ự��ʼʱ����ִ�и÷���������redis������
    public function open($path, $name) {
        $this->redis = new Redis();
        return $this->redis->connect("127.0.0.1",6379);
    }

    // �Ự����ʱ�����ø÷������ر�redis����
    public function close() {
        $this->redis->close();
        return true;
    }

    // �Ự��������ʱ���ø÷������ڽű�ִ�����session_write_close��������֮�����
    public function write($session_id, $data) {
        return $this->redis->hMSet($this->prefix.$session_id, array('expires' => time(), 'data' => $data));
    }

    // ���Զ���ʼ�Ự����ͨ������ session_start() �����ֶ���ʼ�Ự֮��PHP �ڲ����� read �ص���������ȡ�Ự���ݡ�
    public function read($session_id) {
        if($this->redis->exists($this->prefix.$session_id)) {
            return $this->redis->hGet($this->prefix.$session_id, 'data');
        }
        return '';
    }

    // ����Ự�е����ݣ�������session_destroy()���������ߵ��� session_regenerate_id()������������ destroy ����Ϊ TRUE ʱ,����ô˻ص�������
    public function destroy($session_id) {
        if($this->redis->exists($this->prefix.$session_id)) {
            return $this->redis->del($this->prefix.$session_id) > 0 ? true : false;
        }
        return true;
    }

    // �������պ��������������� session.gc_probability �� session.gc_divisor ��������
    public function gc($maxlifetime) {
        $allKeys = $this->redis->keys("{$this->prefix}*");
        foreach($allKeys as $key) {
            if($this->redis->exists($key) && $this->redis->hGet($key, 'expires') + $maxlifetime < time()) {
                $this->redis->del($key);
            }
        }
        return true;
    }
}

// �����Զ����session������
$handler = new Session_custom();
session_set_save_handler(
    array($handler, 'open'),
    array($handler, 'close'),
    array($handler, 'read'),
    array($handler, 'write'),
    array($handler, 'destroy'),
    array($handler, 'gc')
);

// �������д�����Է�ֹʹ�ö�����Ϊ�Ự���������ʱ���������ķ�Ԥ����Ϊ,��ʾ���ű�ִ��֮������exit()֮�󣬴洢��ǰ�Ự���ݲ��رյ�ǰ�Ự
register_shutdown_function('session_write_close');

session_start();
//$handler->write('lala', 'wuzhc');
echo $handler->read('lala');