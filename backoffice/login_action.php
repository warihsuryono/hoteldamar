<?php
	if($_GET['logout']){
		$sql="INSERT INTO log_record (mode,tanggal,username,password,groupid,branch,ip) VALUES ";
		$sql.="('logout',NOW(),'".$_SESSION["username"]."','".$_SESSION["password"]."','".$_SESSION['id_group']."','".$_SESSION['branch']."','".$_SERVER["REMOTE_ADDR"]."')";
		mysql_query($sql,$db);
		session_unset();
		$_SESSION=array();
		$_SESSION['loggedin']=false;
		// echo "logout";
		//echo "<meta http-equiv='Refresh' content='0;index.php'>";		
		echo "
			<script language='javascript'>
				parent.window.location='index.php';
			</script>
		";
	}
	if($_POST['login']){
		//ubah yang non string dan non numeric
		$username=sanitasi($_POST['username']);
		$password=sanitasi($_POST['password']);
		
		// $sql="SELECT PASSWORD(PASSWORD('$password'))";
		// $hsl=mysql_query($sql,$dbi);
		// list($password)=mysql_fetch_array($hsl);
		$sql="SELECT user_account.username AS username,user_account.password AS password,user_account.nama AS nama,user_account.gudang AS gudang,user_account.photo AS photo,user_account.signature AS signature,user_group.id_group AS id_group FROM user_account INNER JOIN user_group ON (user_account.username = user_group.username) WHERE user_account.username='$username'";
		$hsl=mysql_query($sql,$db);
		$rsuser_account=mysql_fetch_array($hsl);
		if ($rsuser_account['password']==$password && $password!=""){
			$_SESSION=array();
			// $sql="UPDATE user_account SET lastlogin='".date("Y-m-d H:i:s")."' WHERE username='$username'";
			// mysql_query($sql,$db);
			$_SESSION['loggedin']=true;
			$_SESSION['id_menu_granted']=array();
			$sql="SELECT id_menu FROM menu_group WHERE id_group='".$rsuser_account['id_group']."'";
			$hslmenu=mysql_query($sql,$db);
			$no=-1;
			$_SESSION['id_menu_granted']=array();
			while($rsmenu=mysql_fetch_array($hslmenu)){
				$no++;
				$_SESSION['id_menu_granted'][$rsmenu['id_menu']]=1;
			}
			//if(!session_is_registered("username")){session_register("username");}
			$_SESSION['username']=$rsuser_account['username'];
			
			//if(!session_is_registered("nama")){session_register("nama");}
			$_SESSION['nama']=$rsuser_account['nama'];
			
			//if(!session_is_registered("nik")){session_register("nik");}
			$_SESSION['nik']=$rsuser_account['nik'];
			
			//if(!session_is_registered("id_group")){session_register("id_group");}
			$_SESSION['id_group']=$rsuser_account['id_group'];
			
			$sql="SELECT group` FROM `group` WHERE id_group='".$rsuser_account['id_group']."'";
			$hsltemp=mysql_query($sql,$db);
			list($namagroup)=mysql_fetch_array($hsltemp);
			
			//if(!session_is_registered("namagroup")){session_register("namagroup");}
			$_SESSION['namagroup']=$namagroup;
			
			//if(!session_is_registered("NowLogin")){session_register("NowLogin");}
			$_SESSION['NowLogin']=date("Y-m-d H:i:s");
			
			$sql="INSERT INTO log_record (mode,tanggal,username,password,groupid,branch,ip) VALUES ";
			$sql.="('login',NOW(),'$username','$password','".$_SESSION['id_group']."','".$_SESSION['gudangid']."','".$_SERVER["REMOTE_ADDR"]."')";
			mysql_query($sql,$db);
			
			$_SESSION["change_menu_left_menu"]=1;
			
			echo "
				<script language='javascript'>
					parent.window.location='index.php';
				</script>
			";
			
		}else{
			$_SESSION=array();
			echo "
				<script language='javascript'>
					alert('Username atau Password Salah!');
				</script>
			";
		}
	}
?>
