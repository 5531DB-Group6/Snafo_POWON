<?php
/**
 * Poat detail
 */

	include './common/common.php';
	//判断帖子ID是否存在
	if(empty($_REQUEST['pid']) || !is_numeric($_REQUEST['pid']))
    {
        $msg = '<font color=red><b>Illegal operation is not allowed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
    }
	$Id=$_REQUEST['pid'];

	//保存帖子回复
	if($_POST['replysubmit'])
    {
        //判断用户是否登录
        if(!$_COOKIE['uid']){

            $notice='Sorry，you have not logged in';
            include 'close.php';
            exit;
        }

        $parentid = $Id;					//跟帖时记录贴子ID
        $titleTmp = dbSelect('gposts','title','pid="'.$parentid.'"','id desc',1);
        $title = $titleTmp[0]['title'];
        $authorid = $_COOKIE['uid'];			//发布人ID
        $content = strMagic($_POST['message']);		//内容
        $addtime = time();				//发表时间
        $groupId = $_POST['gid'];			//类别ID
        $futuredelete = "";

        $n='first, parentid, authorid, title, content, addtime, gid';
        $v='0, '.$parentid.', '.$authorid.',"'.$title.'", "'.$content.'", '.$addtime.', '.$groupId.'';
        $result = dbInsert('gposts', $n, $v);

        $insert_id = dbSelect('gposts','pid','title="'.$title.'"','pid desc',1);
        $insertId = $insert_id[0]['pid'];

        if(!$result)
        {
            $msg = '<font color=red><b>Reply failed，please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }else{
            if(isset($_POST['deletelater'])) {
                $hourlater = intval($_POST['hourlater']) ;
                $minutelater =intval($_POST['minutelater']) ;
                if(is_int($hourlater) && is_int($minutelater)){
                    $deletetime = time()+$hourlater*60*60+$minutelater*60;
                    $deleteresult = dbInsert('postdelete','pid,deletetime',''.$insertId.','.$deletetime.'');
                    if($deleteresult){
                        $futuredelete=" will be deleted in ".$hourlater." hour ".$minutelater." minute later";
                    }
                }
            }

            //更新帖子的回复数量[replycount]
            $result = dbUpdate('gposts', 'replycount=replycount+1', 'pid='.$parentid.'');

            //更新版块表的回复数量[replycount]
            $result = dbUpdate('groups', 'replycount=replycount+1', 'gid='.$groupId.'');
            //header('location:detail.php?id='.$Id);
            $msg = '<font color=red><b>Reply succeeded</b></font>'.$futuredelete;
            $url = 'group_post_detail.php?pid='.$Id;
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
            /*
            $msg = '回帖赠送';
            include 'layer.php';
            */
            exit;

        }

    }


	//点击帖子时访问次数加1
	$result = dbUpdate('gposts', 'hits=hits+1', 'pid='.$Id.' and isdel=0 and first=1');
	if(!$result)
    {
        $msg = '<font color=red><b>The post you are viewing does not exist or has been deleted</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
    }

	//读取帖子信息
	$TiZi = dbSelect('gposts','*','pid='.$Id.' and isdel=0 and first=1','',1);
	$authorid = $TiZi[0]['authorid'];		//作者ID
	$Title = $TiZi[0]['title'];		//标题
	$Content = $TiZi[0]['content'];		//内容
	$Addtime = getFormatTime($TiZi[0]['addtime']);		//发布时间
	$groupId = $TiZi[0]['gid'];		//版块ID
	$Replycount = $TiZi[0]['replycount'];	//回复数量
	$Hits = $TiZi[0]['hits'];			//点击数量
	//$Elite = $TiZi[0]['elite'];		//精华
	//$Rate = $TiZi[0]['rate'];			//所需积分数量

	//读取上一条
	$top = dbSelect('gposts','id','pid>'.$Id.' and isdel=0 and first=1 and gid ='.$groupId.'','id desc',1);
	if($top)
    {
        $topid=$top[0]['pid'];
    }else{
        $topid=false;
    }
	//读取下一条
	$down = dbSelect('gposts','id','pid<'.$Id.' and isdel=0 and first=1and gid ='.$groupId.'','id desc',1);
	if($down){
        $downid = $down[0]['pid'];
    }else{
        $downid = false;
    }



	//读取导航索引
	$category = dbSelect('groups','gid,name,owner','gid='.$groupId.'','',1);
	if($category)
    {
        $smallName = $category[0]['name'];
        $smallId = $category[0]['gid'];
        $BanZhu = $category[0]['owner'];
        /*
        $parentCategory = dbSelect('category','cid,classname','cid='.$category[0]['parentid'].'','',1);
        if($parentCategory)
        {
            $bigName=$parentCategory[0]['classname'];
            $bigId=$parentCategory[0]['cid'];
        }else{
            $msg = '<font color=red><b>非法操作</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }
        */

    }else{

        $msg = '<font color=red><b>illegal operation</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }


	//读取会员信息
	$User = dbSelect('user','username,email,udertype,regtime,lasttime,picture','uid='.$authorid.'','',1);
	if($User)
    {
        $U_sername = $User[0]['username'];
        $E_mail = $User[0]['email'];
        $U_dertype = $User[0]['udertype'];
        $R_egtime = formatTime($User[0]['regtime'],false);
        $L_asttime = formatTime($User[0]['lasttime'],false);
        $P_icture = $User[0]['picture'];
        //$A_utograph = $User[0]['autograph'];
        //$G_rade = $User[0]['grade'];
    }

	//该主题下的所有回复数量
	$TZCount = dbFuncSelect('details','count(pid)','parentid='.$Id.' and isdel=0 and first=0');
	$zCount = $TZCount['count(pid)'];
	$linum = 10;
	$Lpage = empty($_GET['page'])?1:$_GET['page'];
	//循环帖子回复信息
	$select = 't.pid as pid,t.isdisplay as isdisplay,t.authorid as authorid,t.content as content,t.addtime as addtime,t.isdel as isdel,u.username as username,u.email as email,u.udertype as udertype,u.regtime as regtime,u.lasttime as lasttime,u.picture as picture';
	$HTiZi = dbDuoSelect('gposts as t','user as u',' on t.authorid=u.uid',null,null,$select,'t.parentid='.$Id.' and t.isdel=0 and t.first=0','t.pid asc', setLimit($linum));

	$title = $Title.' - '.WEB_NAME;
	$ggg = 'iPhone 游戏软件分享区';


	//查找版主或管理员
	$NBanZhu = explode(',',$BanZhu);
	if(in_array($_COOKIE['uid'], $NBanZhu))
    {
        $GuanLi=true;
    }else{
        if($_COOKIE['udertype'])
        {
            $GuanLi=true;
        }
    }

    /*
	//给帖子付款
	if(!empty($_POST['paysubmit']))
    {
        //判断用户是否登录
        if(!$_COOKIE['uid'])
        {
            $notice='抱歉，您尚未登录';
            include 'close.php';
            exit;
        }

        foreach($_POST['oidarr'] as $key=>$val)
        {
            $nval=explode(',',$val);
            //将order表中的ispay更新为1
            $res = dbUpdate('order', 'ispay=1', 'oid='.$key.'');
            //扣钱
            $res = dbUpdate('user', 'grade=grade-'.$nval[1].'', 'uid='.$_COOKIE['uid'].'');
            //给作者加钱
            $res = dbUpdate('user', 'grade=grade+'.$nval[1].'', 'uid='.$nval[0].'');
        }
        header('location:detail.php?id='.$Id);
        exit;

    }
    */

    /*
	//删除未购买的帖子
	if(!empty($_POST['delsubmit']))
    {
        //判断用户是否登录
        if(!$_COOKIE['uid'])
        {
            $notice='抱歉，您尚未登录';
            include 'close.php';
            exit;
        }
        $arrOid = array_keys($_POST['oidarr']);
        $NarrOid = join(',',$arrOid);
        $result = dbDel('order', 'oid in('.$NarrOid.')');
        header('location:detail.php?id='.$Id);
        exit;
    }
    */

    /*
	//购买帖子,点击及加入订单表
	if(!empty($_GET['pay']))
    {
        //判断用户是否登录
        if(!$_COOKIE['uid'])
        {
            $notice='抱歉，您尚未登录';
            include 'close.php';
            exit;
        }

        //查询订单表中是否有这个购买记录
        $select = 't.title as title,t.authorid as authorid,o.oid as oid,o.tid as tid,o.uid as uid,o.rate as rate';
        $IsOrder = dbDuoSelect('order as o','details as t',' on o.tid=t.id',null,null,$select,'o.uid='.$_COOKIE['uid'].' and t.id='.$Id.'','o.oid asc',1);
        if(!$IsOrder)
        {
            //如果没有购买记录，加入订单表
            $Oresult = dbInsert('order', 'uid,tid,rate,addtime,ispay', $_COOKIE['uid'].','.$Id.','.$Rate.','.time().',0');
        }

        //读取这个用户还没有付款的记录
        $OrderList = dbDuoSelect('order as o','details as t',' on o.tid=t.id',null,null,$select,'o.uid='.$_COOKIE['uid'].' and o.ispay=0','o.oid asc');
        $allpay = dbFuncSelect('order','sum(rate ) as zpay','uid='.$_COOKIE['uid'].' and ispay=0');

    }

	//检查当前浏览用户是否已付费
	$MyOrder = dbSelect('order','*','uid='.$_COOKIE['uid'].' and ispay=1 and tid='.$Id.'','oid asc',1);
    */

	if($GuanLi){
        //删除，放入回收站
        if(!empty($_GET['del'])){

            $result = dbUpdate('gposts', "isdel=1", 'pid='.$Id.'');
            $result = dbUpdate('gposts', "isdel=1", 'parentid = '.$Id.'');
            header('location:group_postlist.php?gid='.$groupId);

        }
        //置顶
        if(!empty($_GET['istop'])){
            $result = dbUpdate('details', "istop=1", 'id='.$Id.'');
            header('location:detail.php?id='.$Id);
        }
        //高亮
        if(!empty($_GET['style'])){
            $result = dbUpdate('details', "style='red'", 'id='.$Id.'');
            header('location:detail.php?id='.$Id);
        }
        //精华
        if(!empty($_GET['elite'])){
            $result = dbUpdate('details', "elite=1", 'id='.$Id.'');
            header('location:detail.php?id='.$Id);
        }
        //删除回帖，放入回收站
        if(!empty($_GET['delht'])){

            $result = dbUpdate('details', "isdel=1", 'id='.$_GET['hid'].'');
            header('location:detail.php?id='.$Id);

        }
        //回帖置顶
        if(!empty($_GET['istopht'])){
            $result = dbUpdate('details', "istop=1", 'id='.$_GET['hid'].'');
            header('location:detail.php?id='.$Id);
        }
        //回帖屏蔽
        if(!empty($_GET['isdislpay'])){
            $result = dbUpdate('details', "isdisplay=1", 'id='.$_GET['hid'].'');
            header('location:detail.php?id='.$Id);
        }
    }

	include template("group_post_detail.html");
