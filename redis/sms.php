<?php

/**
 * System Name: Maddong 1.0
 * User: RATDATA
 * Date: 2016/11/8 4:40
 * ? 2016 MadCTO
 */
class Net
{
    function callInterfaceCommon($data_in = null)
    {
        $data_in=unserialize($data_in);
        if(empty($data_in['id'])||empty($data_in['phone'])||empty($data_in['content']))
        {
            return array('state'=>false,'message'=>json_encode($data_in));exit;
        }
        $URL = "http://xxxxx/sms.aspx";//��Ӫ��URL
        $data =
            [
                'account' => 'xx',
                'password' => 'xxx',
                'userid' => 'xxx',
                'mobile' => $data_in['phone'],
                'content' =>  $data_in['content'],
                'sendTime' => null,
                'action' => 'send',
                'extno' => null,
            ];//Ҫ���͵����� �Լ��޸�
        $ch = curl_init();
        //�ж�ssl���ӷ�ʽ
        if (stripos($URL, 'https://') !== false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        }
        $connttime = 500; //���ӵȴ�ʱ��500����
        $timeout = 15000;//��ʱʱ��15��

        $querystring = "";
        if (is_array($data)) {
            // Change data in to postable data
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $val2) {
                        $querystring .= urlencode($key) . '=' . urlencode($val2) . '&';
                    }
                } else {
                    $querystring .= urlencode($key) . '=' . urlencode($val) . '&';
                }
            }
            $querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
        } else {
            $querystring = $data;
        }
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//������Ϣ
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); //http 1.1�汾
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $connttime);//���ӵȴ�ʱ��
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);//��ʱʱ��
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
        $file_contents = curl_exec($ch);//��÷���ֵ
        $status = curl_getinfo($ch);
        curl_close($ch);

        $call_back_json = json_encode(simplexml_load_string($file_contents, 'SimpleXMLElement', LIBXML_NOCDATA));
        $reslut = json_decode($call_back_json, true);
        $ststus = $reslut['returnstatus'];

        if ($ststus == 'Success') {
            return array('state'=>true);
        } else {
            return array('state'=>false,'message'=>json_encode($reslut));
        }

    }
}

set_time_limit(0);
header("Content-type: text/html; charset=utf-8");
$redis = new Redis();
$redis->pconnect('127.0.0.1', 6379) or die('errot');
$sms = new Net();
while (true) {
    $data = $redis->LPOP('Queue');
    if (!empty($data)) {

        $res = $sms->callInterfaceCommon($data);
        if($res['state'])
        {
            $data= unserialize($data);
            $redis->LPUSH('Queue2', serialize(array('id'=>$data['id'],'status'=>'success','time'=>time())));

        }else
        {
            $data= unserialize($data);
            $redis->LPUSH('Queue2', serialize(array('id'=>$data['id'],'status'=>'fail','time'=>time(),'msg'=>$res['message'])));
        }
    }
    sleep(rand() % 3);
}
