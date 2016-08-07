<div id="hd">
	<div class="wp">
		<div class="hdc cl">
			<h2><a href="./" title="<?php echo $title; ?>"><img src="<?php echo $domain_resource; ?>/images/logo.jpg" height="80" border="0" /></a></h2>
			<?php if($thispage!='logout.php'){?>
				<?php if($_COOKIE['uid'] && $_COOKIE['username']){?>
				<div id="um">
					<div class="avt y"><a href="home_tx.php"><img src="<?php echo $GGpicture; ?>" /></a></div>
					<p>
						<img src="public/images/mailbox.png" style="width: auto; height: auto;max-width: 30px;max-height: 50px" ><a href="mailbox.php" ><b>Mailbox</b></a>
						<strong class="vwmy"><a href="home.php"><?php echo $_COOKIE['username']; ?></a></strong>
					<span class="pipe">|</span><a href="home.php">User Page</a>
					<?php if($_COOKIE['udertype']){?>
					<span class="pipe">|</span><a href="admin_member_list.php">Administration center</a>
					<?php }?>
					<span class="pipe">|</span><a href="logout.php">Exit</a>
					</p>
					<p>
						<a id="extcreditmenu" href="#">Coins: <?php echo $GGcoins; ?></a>
						<span class="pipe">|</span>User Group: <?php echo userGroup($_COOKIE['udertype']); ?>
					</p>
				</div>
				<?php } else { ?>
				<form method="post" autocomplete="off" id="lsform" action="login.php">
				<div class="fastlg cl">
					<div class="y pns">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td><span class="ftid">username</span></td>
								<td><input type="text" name="username" value="<?php echo $_COOKIE['username']; ?>" id="ls_username" autocomplete="off" class="px vm" /></td>
								<td class="fastlg_l">
									<label for="ls_cookietime"><input type="checkbox" name="cookietime" id="ls_cookietime" class="pc" value="true" />Automatic Login</label>
								</td>
								<td>&nbsp;<a href="getpass.php">Retrieve Password</a></td>
							</tr>
							<tr>
								<td><label for="ls_password" class="z psw_w">Password</label></td>
								<td><input type="password" name="password" id="ls_password" class="px vm" autocomplete="off" /></td>
								<td class="fastlg_l"><button type="submit" class="pn vm" name="loginsubmit" value="true" style="width:75px;"><em>Login</em></button></td>
								<td>&nbsp;<a href="reg.php" class="xi2 xw1">Register</a></td>
							</tr>
						</table>
					</div>
				</div>
				</form>
				<?php }?>
			<?php }?>
		</div>
	
		<div id="nv">
			<ul>	
				<li><a href="index.php" hidefocus="true" title="<?php echo $web_name; ?>">Home</a><span><?php echo $web_name; ?></span></li>
				<li><a href="member.php?mlist=1" hidefocus="true" title="My Friends">My Friends</a><span><?php echo $web_name; ?></span></li>
				<li><a href="group.php?glist=1" hidefocus="true" title="My Groups">My Groups</a><span><?php echo $web_name; ?></span></li>
			</ul>
		</div>
		
		<div id="scbar" class="cl">
			<form id="scbar_form" method="get" autocomplete="off" action="search.php" target="_blank">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="scbar_icon_td"></td>
					<td class="scbar_txt_td"><input type="text" name="keywords" id="scbar_txt" onfocus="if(this.value=='please enter search detail'){this.value='';this.style.color='#666';}" onblur="if(this.value==''){this.value='please enter search detail';this.style.color='#ccc';}" value="please enter search detail" style="color:#CCCCCC" autocomplete="off" /></td>
					<td class="scbar_btn_td">
						<button type="submit" name="searchsubmit" id="scbar_btn" class="pn pnc" value="true"><strong class="xi2 xs2">Search</strong></button>
					</td>
					<td class="scbar_hot_td">
						<div id="scbar_hot">

						</div>
					</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
