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

        <div class="mn">
            </div>
            <div class="fl bm">
                <!--group start-->
                <div class="bm bmw  cl">
                    <div class="bm_h cl">
                        <table cellspacing="0" cellpadding="0">
                            <th>
                                <?php if($Glist==0){?>
                                <h2><a href="group.php?glist=0">All Groups</a></h2>
                                <?php } else { ?>
                                <h2><a href="group.php?glist=1">My Groups</a></h2>
                                <?php }?>
                            </th>
                            <td><span class="pipe">|</span></td>
                            <td class="common" style="text-align: right">
                            <h3><a href="group_reg.php" style="color: rgba(159, 27, 5, 0.94);">Create Group</a></h3>
                            </td>
                        </table>
                    </div>
                    <div id="category_1" class="bm_c">
                        <table cellspacing="0" cellpadding="0" class="fl_tb">
                            <?php if($Glist==0){?>
                            <?php if(is_array($GrMenuAll)){foreach($GrMenuAll AS $key=>$val) { ?>
                            <?php if($key%4==0 and $key!=0){?><tr> </tr><?php }?>
                            <td style="width:60px;height:80px;text-align: center;" >
                                <a href="group_postlist.php?gid=<?php echo $val['gid']; ?>"><img src="<?php echo $val['grouppic']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" alt="<?php echo $val['name']; ?>" /></a>
                            </td>
                            <td>
                                <h2><a href="group_postlist.php?gid=<?php echo $val['gid']; ?>" style="color:<?php echo $val['namestyle']; ?>"><?php echo $val['name']; ?></a></h2>
                                <p class="xg2"><?php echo $val['description']; ?></p>
                                <?php if(!empty($val['owner'])){?>
                                <p>Owner: <span class="xi2"><?php echo getUserName($val['owner']); ?></span></p>
                                <p><a href="group.php?gid=<?php echo $val['gid']; ?>&ap=1">Apply</a></p>
                                <?php }?>
                            </td>
                            <?php }}?>
                            <?php } else { ?>
                            <?php if(is_array($GrMenu)){foreach($GrMenu AS $key=>$val) { ?>
                            <?php if($key%4==0 and $key!=0){?><tr> </tr><?php }?>
                            <td style="width:60px;height:80px;text-align: center;" >
                                <a href="group_postlist.php?gid=<?php echo $val['gid']; ?>"><img src="<?php echo $val['grouppic']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" alt="<?php echo $val['name']; ?>" /></a>
                            </td>
                            <td>
                                <h2><a href="group_postlist.php?gid=<?php echo $val['gid']; ?>" style="color:<?php echo $val['namestyle']; ?>"><?php echo $val['name']; ?></a></h2>
                                <p class="xg2"><?php echo $val['description']; ?></p>
                                <?php if(!empty($val['owner'])){?>
                                <p>Owner: <span class="xi2"><?php echo getUserName($val['owner']); ?></span></p>
                                <?php }?>
                            </td>
                            <?php }}?>
                            <?php }?>
                        </table>
                    </div>
                </div>
                <!--group end-->
            </div>


        </div>
</div>
<!--CONTENT end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

