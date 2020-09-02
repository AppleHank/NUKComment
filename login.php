
<?php 
$uid=$_POST['uid'];
$pwd=$_POST['upwd'];
$serverName = "140.127.218.154:3306";

$link = mysqli_connect(
	$serverName,
	'nukcomet2589',
	'commentnuk2589',
	'nukcomet');

if(!$link){
	echo "Failed to connect to database!";
}

else{

	mysqli_select_db($link, 'nukcomet');

	if (!mysqli_select_db($link, 'nukcomet')){
		echo "Unable to open database nukcomet...<br/>";
	}

	$sql = "SELECT user_id, user_pwd FROM user";
	$result = mysqli_query($link, $sql);

	while($row = mysqli_fetch_assoc($result)){
		if($row['user_id']==$uid){
			if($row['user_pwd']==$pwd){
				//登入成功之後
				echo "<h2>登入成功！</h2>";
				break;
			}else{
				echo "<h2>密碼有誤，請<a href='index.html#notice'>重新登入</a></h2>";
				break;
			}
		}
	}

	if(!isset($row['user_id'])){
		echo "<h2>帳號有誤或尚未註冊，請<a href='index.html#notice'>重新登入</a></h2>";
	}

	mysqli_close($link);
}

?>