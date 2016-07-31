<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--HEAD start-->
<?php include template("head.html");?>
<!--HEAD end-->

<!--LIST start-->
<div id="wp" class="wp">
	<div id="pt" class="bm cl">
		<div class="z">
			<a href="./" class="nvhm" title="首页"><?php echo $title; ?></a> <em>&rsaquo;</em><a href="home.php">设置</a> <em>&rsaquo;</em>修改头像
		</div>
	</div>
	<div id="ct" class="ct2_a wp cl">
		<div class="mn">
		<div class="bm bw0">
		<form action="" method="post" autocomplete="off" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" class="tfm">
		<caption>
			<h2 class="xs2">当前我的头像</h2>
			<p>如果您还没有设置自己的头像，系统会显示为默认头像，您需要自己上传一张新照片来作为自己的个人头像 </p>
		</caption>
			<tr>
				<td>
				<img src="<?php echo $result[0]['picture']; ?>" style="border:1px solid #ccc;width:auto;height:auto;max-width: 150px;max-height:200px;" /><br /><br /><br />
				<h2 class="xs2">设置我的新头像</h2><br />
				<input name="pic" type="file" style="height:23px; width:300px;" />
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnc" /><strong>保存</strong></button>
				</td>
			</tr>
		</table>
		</form>
		</div>
		</div>
	
		<div class="appl">
			<div class="tbn">
				<h2 class="mt bbda">设置</h2>
				<ul>
					<li class="a"><a href="home_tx.php">Change Avatar</a></li>
					<li><a href="home.php">Personal Info</a></li>
					<li><a href="home_friend.php">Friend Requests</a></li>
					<li><a href="home_qm.php">个人签名</a></li>
					<li><a href="home_pass.php">密码安全</a></li>
					<!--<li><a href="home_sc.php">收藏管理</a></li>-->
				</ul>
			</div>
		</div>
	</div>
</div>
<!--LIST end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

