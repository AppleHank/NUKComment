<?php 

session_start();
$uid=$_SESSION['uid'];
$pwd=$_SESSION['upwd'];

// echo $_SESSION['$mailadd']."<br/>".$_POST['vcode']."<br/>".$_SESSION['uid'];
// echo $_SESSION['upwd'];

if ($_SESSION['$mailadd']==$_POST['vcode']) {
	$link = @mysqli_connect(
			"140.127.218.154:3306",
			'nukcomet2589',
			'commentnuk2589',
			'nukcomet');

		if(!$link){
			echo "Failed to connect to database!";
		}

		else{

			mysqli_select_db($link, 'nukcomet');

			if (!mysqli_select_db($link, 'nukcomet')){
				echo "Unable to open database 'nukcomet'...<br/>";
			}else{

				//新增資料
				$sql_insert = "INSERT INTO user (user_id, user_pwd) VALUES('$uid', '$pwd')";
				mysqli_query($link, $sql_insert) or die ("無法新增".mysql_error());

				echo "註冊成功";

				mysqli_close($link);
				session_destroy();
			}
		}
}else{
	echo "驗證碼有誤！";
}

 ?>