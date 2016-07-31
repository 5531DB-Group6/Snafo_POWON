<?php
/**
 * 个人资料，用户签名
 */

include './common/common.php';

//判断用户是否登录
if(empty($_COOKIE['uid']))
{
    $msg = '<font color=red><b>you have not logged in</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

if(empty($_GET['gid']) || !is_numeric($_GET['gid']))
{
    $msg = '<font color=red><b>Illegal operation is not allowed</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}else{
    $groupId = $_GET['gid'];
}

$result = dbSelect('gmembers','uid,approved,admin','uid='.$_COOKIE['uid'].' and gid='.$groupId.'','',1);
$approved = $result[0]['approved'];
$admin = $result[0]['admin'];
if(!$result)
{
    $msg = '<font color=red><b>You are not a member of the group</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

$OnMenu = dbSelect('groups','gid,name,owner,grouppic','gid='.$groupId.' and ispass=1','orderby desc,gid desc');
if(!$OnMenu)
{
    $msg = '<font color=red><b>cannot find the group</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
}else{
    $OnGid = $OnMenu[0]['gid'];
    $OnGname = $OnMenu[0]['name'];
    $Owner = $OnMenu[0]['owner'];
    $Gpic=$OnMenu[0]['grouppic'];
    $isOwner = ($Owner == $_COOKIE['uid'])? 1:0;
}
if ($admin) {
//修改头像
    if($_POST['profilesubmitbtn'])
    {
        if(!$_FILES['pic'])
        {
            $msg = '<font color=red><b>please select a picture</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }

        $picture = upload('pic');
        $owner = dbUpdate('groups', 'grouppic="'.$picture.'"', 'gid='.$groupId.'');
        if($owner){
            header('location:group_info.php?gid='.$groupId.'');
        }else{
            $msg = '<font color=red><b>error，please contact the admin</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }
    }

    if ($_POST['invitesubmitbtn']) {
        $username = strMagic($_POST['username']);

        $select = 'u.uid as uid, u.username as username,u.picture as picture,m.approved as approved';
        $MemberList = DBduoSelect('user as u', 'gmembers as m', 'on u.uid = m.uid', null, null, $select, 'm.gid =' . $groupId . ' and u.username="' . $username . '"');

        if ($MemberList) {
            if ($MemberList[0]['approved'] == 1) {
                $msg = '<font color=red><b>the user is already a member of the group</b></font>';
                $url = $_SERVER['HTTP_REFERER'];
                $style = 'alert_error';
                $toTime = 3000;
                include 'notice.php';
                exit;
            } else {
                $result = dbUpdate('gmembers', 'approved=1', 'uid=' . $MemberList[0]['uid'] . ' and gid=' . $groupId . '');
                if ($result) {
                    $msg = '<font color=red><b>operation succeeded</b></font>';
                    $url = $_SERVER['HTTP_REFERER'];
                    $style = 'alert_right';
                    $toTime = 3000;
                    include 'notice.php';
                    exit;
                } else {
                    $msg = '<font color=red><b>operation failed, please contact the administrator</b></font>';
                    $url = $_SERVER['HTTP_REFERER'];
                    $style = 'alert_error';
                    $toTime = 3000;
                    include 'notice.php';
                    exit;
                }
            }

        }

        $Target = dbSelect('user', 'uid', 'username="' . $username . '"', '', 1);

        if (!$Target) {
            $msg = '<font color=red><b>such user cannot be found</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }

        $Tuid = $Target[0]['uid'];
        $result = dbInsert('gmembers', 'gid,uid,approved', '' . $groupId . ',' . $Tuid . ',1');
        if ($result) {
            $msg = '<font color=red><b>operation succeeded</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
            exit;
        } else {
            $msg = '<font color=red><b>operation failed, please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }
    }
}

if($isOwner) {
    if ($_POST['destroyubmitbtn']) {
        $result = dbDel('groups', 'gid='.$groupId . '');
        if ($result) {
            $msg = '<font color=red><b>operation succeeded</b></font>';
            //$url = $_SERVER['HTTP_REFERER'];
            header('location:group.php');
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
            exit;
        } else {
            $msg = '<font color=red><b>operation failed, please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }
    }
}
else{
    if ($_POST['leavesubmitbtn']) {
        $result = dbDel('gmembers', 'uid='.$_COOKIE['uid'].' and gid='.$groupId.'');
        if ($result) {
            $msg = '<font color=red><b>operation succeeded</b></font>';
            //$url = $_SERVER['HTTP_REFERER'];
            header('location:group.php?glist=1');
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
            exit;
        } else {
            $msg = '<font color=red><b>operation failed, please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }
    }
}


$title = 'Group Operation - '.WEB_NAME;
include template("group_info.html");

