<?php 


if($_POST['upwd']!=$_POST['upwd2']){
	echo "密碼不一致，請重新註冊！";
	header("Refresh:2; url='index.html#notice1'");
}else{

$mailadd = $_POST['email'];

function randomkeys($length){
	$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for($i=0;$i<$length;$i++){
		$key .= $pattern{rand(0,61)};
	}
	return $key;
}

function start_session($expire = 0)
{
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }

    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
        session_start();
    } else {
        session_start();
        setcookie('PHPSESSID', session_id(), time() + $expire);
    }
}

if(isset($mailadd)){
	if(preg_match("/^[a-zA-z][0-9]{7}@mail\.nuk\.edu\.tw$/", $mailadd)){
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
				//檢查是否已註冊
				start_session(600);
				$_SESSION['uid'] = $mailadd;
				$_SESSION['upwd'] = $_POST['upwd'];

				$rgt=1;
				$sql = "SELECT user_id FROM user";
				$result = mysqli_query($link, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['user_id']==$mailadd){
						echo "此信箱已註冊過！";
						$rgt=0;
					}
				}
				//發送驗證碼
				if($rgt){
					$vcode=randomkeys(7);
					$_SESSION['$mailadd']=$vcode;
					// echo $_SESSION[$mailadd];
					$from = 'happyfishkend@gmail.com';
					$to = $mailadd;
					$subject = '鈕課彗星註冊驗證';

					require("../PHPMailer/src/PHPMailer.php");
					require("../PHPMailer/src/SMTP.php");
					require("../PHPMailer/src/Exception.php");

					$mail = new PHPMailer\PHPMailer\PHPMailer();
					$mail->isSMTP();
					$mail->SMTPDebug = 2;
					$mail->Host = 'smtp.nuk.edu.tw';
					$mail->CharSet = "utf-8";
					$mail->setFrom($from);
					$mail->addReplyTo($from);
					$mail->addAddress($to);
					$mail->Subject = "=?utf-8?B?".base64_encode($subject)."?=";
					$mail->Body = "感謝您加入鈕課彗星！您的驗證碼為 ".$_SESSION['$mailadd']."，請輸入驗證碼以完成註冊";
					$mail->send();
					if(!$mail->Send()) {
						echo "發送錯誤: " . $mail->ErrorInfo;
					} else {
						echo '<form action="add.php" method="post">
					已將驗證碼寄至您的高大信箱!<br/>
					請輸入驗證碼: <input type="text" name="vcode"><input type="submit"></form>';
					}

				}

				mysqli_close($link);
			}
		}
	}else{
		echo "email格式有誤(請使用高大信箱)";
	}
}
}

?>