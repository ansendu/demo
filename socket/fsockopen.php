<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 21:01
 */

function check_url($url)
{
    //����url
    $url_pieces = parse_url($url);
    //������ȷ��·���Ͷ˿ں�
    $path = (isset($url_pieces['path'])) ? $url_pieces['path'] : '/';
    $port = (isset($url_pieces['port'])) ? $url_pieces['port'] : '80';
    //��fsockopen()��������
    if ($fp = fsockopen($url_pieces['host'], $port, $errno, $errstr, 30)) {
        //�����ɹ����������д������
        $send = "HEAD $path HTTP/1.1\r\n";
        $send .= "HOST:" . $url_pieces['host'] . "\r\n";
        $send .= "CONNECTION: CLOSE\r\n\r\n";

        stream_set_blocking($fp, 1);
//        stream_set_timeout($fp, 10);
        fwrite($fp, $send);

        $res = stream_get_meta_data($fp);
        print_r($res);exit;

//        while (!feof($fp)) {
//            if (($head = @fgets($fp)) && ($head == "\r\n" || $head == "\n")) {
//                echo $head.'sss';
//                echo php_sapi_name() == 'cli' ? PHP_EOL : '<br>';
//                break;
//            }
//        }

        //����HTTP״̬��
        $data = fgets($fp, 128);

//        $data = '';
//        while (!feof($fp)) {
//            $data .= @fgets($fp);
//        }

//        echo $data; exit;


        //�ر�����
        fclose($fp);
        //����״̬�������Ϣ
        list($response, $code) = explode(' ', $data);
        if ($code == 200) {
            return array($code, 'good');
        } else {
            return array($code, 'bad');//����ڶ���Ԫ����Ϊcss����
        }
    } else {
        //û������
        return array($errstr, 'bad');
    }

}

//����URL�б�
$urls = array(
//    'http://xinxin54.pw/search.asp?searchword=%B0%D7%C4%BE%D3%C5%D7%D3',
//    'http://www.example.com',
    'http://www.cnblogs.com/baocheng/p/5902560.html'
);
//����PHP�ű���ʱ�����ƣ�
//set_time_limit(0);//���޳�ʱ���������
//�����֤url��
foreach ($urls as $url) {
    list($code, $class) = check_url($url);
    echo "<p><a href =\"$url\">$url</a>(<span class =\"$class\">$code</span>)</p>";

}
?>