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

$uid = $_GET['uid'];

if ($uid == $_COOKIE['uid']){
    header('location:home.php');
}


$User = dbSelect('user','*','uid='.$uid.'','',1);

if(empty($User)) {
    $msg = '<font color=red><b>such user is not found</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}else{
    $uname = $User[0]['username'];
    $upic = $User[0]['picture'];
    switch ($User[0]['sex']){
        case 1:
            $ugender = 'femal';
            break;
        case 2:
            $ugender = 'male';
            break;
        default:
            $ugender = 'secret';
    }
    $ubirthday = $User[0]['birthday'];
    $uplace = $User[0]['region'];
    $uprofiession = $User[0]['profession'];
}

$Friend = dbSelect('friend','uid,approved,type','uid='.$_COOKIE['uid'].' and fid='.$uid.'','',1);
$friendApp = $Friend[0]['approved'];
$friendType = $Friend[0]['type'];

// profile visibility
$visible = dbSelect('profilevisible','*','uid='.$uid.'','',1);
//

$FriendRequest = dbSelect('friend','uid,approved,type','fid='.$_COOKIE['uid'].' and uid='.$uid.' and approved=0','',1);

if($_POST['friendsubmitbtn']) {
    if ($friendApp==1){
        $msg = '<font color=red><b>You are already a friend of him/her</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }

    if (!empty($Friend) && $friendApp==0){
        $msg = '<font color=red><b>You have already sent a request</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }

    $result = dbInsert('friend','uid,fid,type,addtime',''.$_COOKIE['uid'].','.$uid.','.$_POST['type_apply'].','.time().'');
    if(empty($result)){
        $msg = '<font color=red><b>operation failed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }else{
        header('location:member_home.php?uid='.$uid.'');
    }
}

if($_POST['cancelsubmitbtn']) {
    if (empty($Friend) || $friendApp==0){
        $msg = '<font color=red><b>You are not friends</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }

    $result1 = dbDel('friend','uid='.$_COOKIE['uid'].' and fid ='.$uid.'');
    $result2 = dbDel('friend','fid='.$_COOKIE['uid'].' and uid ='.$uid.'');
    if(empty($result1)||empty($result2)){
        $msg = '<font color=red><b>operation failed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }else{
        header('location:member_home.php?uid='.$uid.'');
    }
}

if($_POST['changesubmitbtn']) {
    if (empty($Friend) || $friendApp==0){
        $msg = '<font color=red><b>You are not friends</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }

    if($friendType==$_POST['type_change']){
        header('location:member_home.php?uid='.$uid.'');
    }

    $result = dbUpdate('friend','type='.$_POST['type_change'].'','uid='.$_COOKIE['uid'].' and fid ='.$uid.'');
    if(empty($result)){
        $msg = '<font color=red><b>operation failed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }else{
        header('location:member_home.php?uid='.$uid.'');
    }
}

$title = 'Member Information - '.WEB_NAME;
include template("member_home.html");

