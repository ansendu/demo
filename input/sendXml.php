<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��03��20��
 * Time: 13:57
 *
 * file_get_contents('php://input')ʹ�ð���1
 *
 */
include '../log.php';

$xml = '<xml><eg>ergh</eg><ss>dddd</ss></xml>';//Ҫ���͵�xml
$url = 'http://wuzhc.cm/test/input/getXml.php';//����XML��ַ
$header = 'Content-type: text/xml';//����content-typeΪxml

$ch = curl_init(); //��ʼ��curl
curl_setopt($ch, CURLOPT_URL, $url);//��������
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//�����Ƿ񷵻���Ϣ 1�᷵�����ݣ�0ֱ����ʾ����
curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));//����HTTPͷ
curl_setopt($ch, CURLOPT_POST, 1);//����ΪPOST��ʽ
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);//POST����
$response = curl_exec($ch);//���շ�����Ϣ
if (curl_errno($ch)) {//��������ʾ������Ϣ
    print curl_error($ch);
}

curl_close($ch); //�ر�curl����
//echo $response;//��ʾ������Ϣ

