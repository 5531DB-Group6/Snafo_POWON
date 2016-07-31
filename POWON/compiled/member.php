<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--HEAD start-->
<?php include template("head.html");?>
<!--HEAD end-->

<!--CONTENT start-->
<div id="wp" class="wp">
    <div id="pt" class="bm cl">
        <div class="z">
            <a href="./" class="nvhm" title="<?php echo $title; ?>"><?php echo $title; ?></a><em>&raquo;</em><a href="index.php">Home</a>
        </div>
        <div class="z"></div>
    </div>

    <?php if($Mlist==0){?>
    <div class="mn">
    </div>
    <div class="fl bm">
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <table cellspacing="0" cellpadding="0">
                    <th>
                        <h2><a href="member.php?mlist=0">POWON Members</a></h2>
                    </th>
                </table>
            </div>
            <div id="memberlist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($UserList)){foreach($UserList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <h2><p><span class="xi2"><?php echo $val['username']; ?></span></p></h2>
                    </td>
                    <?php }}?>
                    <?php
                    for($i = 1;$i <= $UserListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="mn">
    </div>
    <div class="fl bm">
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <table cellspacing="0" cellpadding="0">
                    <th>
                        <h2><a href="member.php?mlist=1">My Friends</a></h2>
                    </th>
                    <?php if(!empty($FriendRequest)){?>
                    <td><span class="pipe">|</span></td>
                    <td class="common" style="text-align: right">
                        <a href="home_friend.php" style="color: rgba(159, 27, 5, 0.94);"><b>You have a friend request</b></a>
                    </td>
                    <?php }?>
                </table>
            </div>
            <div id="friendslist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($FriendList)){foreach($FriendList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <h2><p><span class="xi2"><?php echo $val['username']; ?></span></p></h2>
                    </td>
                    <?php }}?>
                    <?php if(!empty($FriendList)){?>
                    <?php
                    for($i = 1;$i <= $FriendListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                    }
                    ?>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>

    <div class="mn">
    </div>
    <div class="fl bm">
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <table cellspacing="0" cellpadding="0">
                    <th>
                        <h2><a href="member.php?mlist=1">My Families</a></h2>
                    </th>
                </table>
            </div>
            <div id="familylist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($FamilyList)){foreach($FamilyList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <h2><p><span class="xi2"><?php echo $val['username']; ?></span></p></h2>
                    </td>
                    <?php }}?>
                    <?php if(!empty($FamilyList)){?>
                    <?php
                    for($i = 1;$i <= $FamilyListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                    }
                    ?>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>

    <div class="mn">
    </div>
    <div class="fl bm">
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <table cellspacing="0" cellpadding="0">
                    <th>
                        <h2><a href="member.php?mlist=1">My Colleagues</a></h2>
                    </th>
                </table>
            </div>
            <div id="Colleagueslist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($ColleagueList)){foreach($ColleagueList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <h2><p><span class="xi2"><?php echo $val['username']; ?></span></p></h2>
                    </td>
                    <?php }}?>
                    <?php if(!empty($ColleagueList)){?>
                    <?php
                    for($i = 1;$i <= $ColleagueListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                    }
                    ?>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
    <?php }?>
</div>
<!--CONTENT end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

