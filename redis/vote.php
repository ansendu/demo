<?php
/**
 * ����˵����
 * 1������ǰ50
 * 2����ʱ������Ŷ����ϼ��ٷ���
 * 3������һ��֮������ͶƱ
 * 4��ÿ���û�ֻ��Ͷһ�α�
 *
 * @author wuzhc2016@163.com
 * @since 2017-06-22
 */

define('VOTE_SCORE', 432);
define('ONE_WEEK_IN_SECONDS', 7 * 86400);
$redis = new Redis();
$redis->connect('127.0.0.1');

/**
 * �������£��Զ����ɣ�
 * hash article:id=>content
 * @param int $uid ��������uid
 */
function add_article($uid = 1)
{
    global $redis;
    $titles = [
        'this is a book',
        'nothing to do',
        'hello , redis',
        'can not access'
    ];
    $id = $redis->incr('article_id');
    $time = time();
    $vote = 0;
    $rs = $redis->hMset('article:'.$id, [
        'time'   => $time,
        'vote'   => $vote,
        'author' => 'user:' . $uid,
        'title'  => $titles[rand(0,count($titles)-1)],
    ]);
    if ($rs) {
        $redis->zAdd('time:', time(), 'article:'.$id);
    }
}

/**
 * ����ͶƱ
 * zset member=>article:id , score=>vote_score
 * @param int $articleID ����ID
 * @param int $uid �û�ID
 * @return bool
 */
function article_vote($articleID, $uid)
{
    global $redis;
    // �ж��Ƿ��Ѿ�����
    $createTime = $redis->hGet('article:'. $articleID, 'time');
    if (!$createTime) {
        return false;
    }
    $now = time();
    if ($now - ONE_WEEK_IN_SECONDS > $createTime) {
        // �Ѿ����ڣ�ɾ����ͶƱ�û�����
        $redis->del('voted:'.$articleID);
        return false;
    } else {
        // δ���ڣ����û����뵽��ͶƱ����
        if ($redis->sAdd('voted:'.$articleID, $uid)) {
            // ��������ͶƱ����
            $redis->zIncrBy('score:', VOTE_SCORE, 'article:'.$articleID);
            // ��������ͶƱ��
            $redis->hIncrBy('article:'.$articleID, 'vote', 1);
            return true;
        }
    }
    return false;
}

// ģ�ⷢ��1500������
for ($i=0; $i<1500; $i++) {
    add_article();
}

// ģ��10000�ζ�1500�����½���ͶƱ
for ($i=0; $i<10000; $i++) {
    article_vote(rand(1,1500), rand(1, 10000));
}
