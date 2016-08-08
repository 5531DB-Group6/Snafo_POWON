<?php
	if(file_exists('../install.lock')){
		exit('网站已经被安装过了，如果需要重新安装网站，请删除 /install.lock 文件');
	}
	include '../config/database.php';
	if(!empty($_POST['submitname'])){

			$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			
			if(mysqli_errno($conn)){
			
				exit(mysqli_error($conn));
			}
			
			mysqli_set_charset($conn, DB_CHARSET);

            $username=trim($_POST['username']);
			
			$password=md5(trim($_POST['password']));
			
			$time=time();
			
			$email=trim($_POST['email']);
			
			$sql="insert into ".DB_PREFIX."user(uid,username,password,email,udertype,regtime,lasttime) values(1,'{$username}','{$password}','{$email}',1,$time,$time)";


			$result=mysqli_query($conn, $sql);
			
			if($result && mysqli_affected_rows($conn))
			{

				$uid=$result[0]['uid'];
				$n = "`uid`";
				$v = "$uid";
				$result = dbInsert('profilevisible',$n,$v);

				echo 'installation done';
				file_put_contents('../install.lock','');
				header('location:../index.php');
				exit;
			
			}else{
			
				echo 'installation failed';
				
			}

			mysqli_close($conn);
			
	}
	
?>