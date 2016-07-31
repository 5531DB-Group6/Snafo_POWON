<?php
/**
 * 个人资料
 */

include './common/common.php';

//判断用户是否登录
if(empty($_COOKIE['uid']))
{
    $msg = '<font color=red><b>You have not logged in</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

$select='u.uid as uid, u.username as username, u.picture as picture';
$Friend = dbDuoSelect('friend as f','user as u','on u.uid=f.uid and f.approved=0',null,null,$select,'f.fid='.$_COOKIE['uid'].'','f.addtime desc');

if ($_POST['approvesubmitbtn']){
    $uid=$_POST['approvesubmitbtn'];
    $type = $_POST['type_'.$uid.''];

    $result = dbupdate('friend', 'approved=1','uid='.$uid.' and fid='.$_COOKIE['uid'].'');
    $insert = dbInsert('friend','uid,fid,approved,type,addtime',''.$_COOKIE['uid'].','.$uid.',1,'.$type.','.time().'');

    if($result && $insert){
        header('location:home_friend.php');
    }else{
        $msg = '<font color=red><b>'.$type.'operation failed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }
}

if ($_POST['rejectsubmitbtn']){
    $uid=$_POST['rejectsubmitbtn'];

    $result = dbDel('friend','uid='.$uid.' and fid='.$_COOKIE['uid'].' and approved=0');

    if($result){
        header('location:home_friend.php');
    }else{
        $msg = '<font color=red><b>'.$type.'operation failed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }
}


$title = '个人资料 - '.WEB_NAME;
include template("home_friend.html");

