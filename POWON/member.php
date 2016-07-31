<?php
/**
 * group
 */
include './common/common.php';

$title = 'Member - ' . WEB_NAME;
$menu = WEB_NAME;

$Mlist = $_GET['mlist'];

//判断用户是否登录
if(!$_COOKIE['uid'])
{
    $notice = 'Sorry, you have not logged in，';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

$UserList = dbSelect('user','uid,username,picture','uid<>'.$_COOKIE['uid'].'','username asc');
$UserListRest = 8-count($UserList)%8;
$UserListRest = ($UserListRest ==8)? 0:$UserListRest;

$select='u.uid as uid, u.username as username, u.picture as picture';
$FriendList = DBduoSelect('user as u','friend as f','on u.uid = f.fid and f.approved=1',null,null,$select,'f.uid ='.$_COOKIE['uid'].' and f.type=0','u.username asc');
$FriendListRest = 8-count($FriendList)%8;
$FriendListRest = ($FriendListRest ==8)? 0:$FriendListRest;

$FamilyList = DBduoSelect('user as u','friend as f','on u.uid = f.fid and f.approved=1',null,null,$select,'f.uid ='.$_COOKIE['uid'].' and f.type=1','u.username asc');
$FamilyListRest = 8-count($FamilyList)%8;
$FamilyListRest = ($FamilyListRest == 8)? 0:$FamilyListRest;

$ColleagueList = DBduoSelect('user as u','friend as f','on u.uid = f.fid and f.approved=1',null,null,$select,'f.uid ='.$_COOKIE['uid'].' and f.type=2','u.username asc');
$ColleagueListRest = 8-count($ColleagueList)%8;
$ColleagueListRest = ($ColleagueListRest == 8)? 0:$ColleagueListRest;

$FriendRequest = dbSelect('friend','uid,approved,type','fid='.$_COOKIE['uid'].' and approved=0','');


include template("member.html");