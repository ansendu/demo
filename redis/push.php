<?php          //push��������  ע:ʹ��ǰ��ȷ��log�ļ�Ϊ��       2016-04-12
include_once(dirname (__FILE__)."/../../config.inc.php");
//if(exec('ps aux | grep redis_push.php | grep -v grep | wc -l') != 0) goto check;
import('push.class.php');
import('Redis.class.php');

$time  =time();
$data  = array("apikey"=>'xxxx',"secret"=>'xxxx');
$push  = new Channel($data);
$redis = new RedisCache($Credis['host'],$Credis['port']);
if(exec('ps aux | grep redis_push.php | grep -v grep | wc -l') != 0) goto check;//������������� ֱ��ִ�м�ش���

/*PUSH������*/
$config = array(
    "file"=>"test.txt",
    "Title"=>"sssss",
    "Content"=>"ssssssssssssssss",
    "OpenType"=>"0",    //1��  0��    �Ƿ���ת����
    "Url"=>"",         //���ӵ�ַ
    "num"=>"500",      //ÿ����������
    "s"=>"1"           //˯��ʱ�� ����λ���룩
);
$num = 15;            //������������
$a = $config['OpenType']==1 ? "��" : "��";
$c = json_encode($config);
$info = <<<monkey
   ************ ��ȷ����Ϣ�Ƿ�����*10�������push����! *************
   * �ļ�����   : {$config['file']};
   * ���ͱ���   : {$config['Title']};
   * ��������   : {$config['Content']};
   * �Ƿ���ת   : {$config['OpenType']};
   * ��������   : $num;(���Ϊ���������Ӵ���)
   * ˯��ʱ��   : {$config['s']};
   * ��־Ŀ¼   : /log;
   ***************************************************************\n
monkey;
echo $info;
sleep(3);
$n = 1;
while($n<=10){
    echo (10-$n++),"��\n";
    sleep(1);
}
echo "------------------------- ���������� -------------------------\n";
if($redis->Scount('push_getchannel_success')){
    echo "������δ�������\n";
}else{
    $res = exec("php redis_getchannel.php {$config['file']}");//д��redis�ű�
    echo $res;
}
smtp_mail('xxxx@qq.com','���������ѿ���','��ʵʱ���,5��������ֻ������յ���������!');//���ͼ�� ʵ�ֶ�ʱȫ�Զ����� 
echo "\n---------------- 5��� test ���յ�����������Ϣ ----------------\n";
sleep(5);
$re = $push->BaiduPush('xxxx','xxxxx',$config['Content'],$config['Title'],'1',$config['OpenType'],$config['Url'],'xxxxx',$push);
sleep(1);
echo "\n---------------- ���������ѷ���!��δ�յ�,�뼰ʱ��ֹ����! 10�����ʽ����!!! ----------------\n";
$m = 1;
while($m<=10){
    echo (10-$m++),"��\n";
    sleep(1);
}
echo "\n---------------- ���������Ѿ���ʼ!�����ĵȴ�! ----------------\n";
//���������Ƿ�����
for($i=1;$i<=$num;$i++){
    exec("php redis_push.php  '{$c}' > /dev/null 2>&1 &");
}

check:
while(1){
    if(exec('ps aux | grep redis_push.php | grep -v grep | wc -l') == 0){
        echo "push ������� ��ʱ",time()-$time,"��";
        die();
    }
    echo "��ǰ��������",exec('ps aux | grep redis_push.php | grep -v grep | wc -l'),"��","\n";
    echo "��ǰʣ������������".$redis->Scount('push_getchannel_success')."\n";
    sleep(10);
}