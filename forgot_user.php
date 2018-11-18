<?php
session_start();
include_once 'config/database.php';

try{
	$_SESSION['error'] = null;

	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (isset($_POST['forgot'])) {
		
		$email = htmlentities($_POST['email']);
		if (empty($email)) {
			$_SESSION['error'] = 'Email cannot be empty';
			header("location:forgot.php");
			return;
		}
		else {
			$query = $db->prepare("SELECT * FROM users WHERE email= :email");
			$query->execute(array(':email' => $email));

			if ($query->rowCount() > 0) {

				$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$str = str_shuffle($str);
				$str = substr($str, 0, 8);

				$hashed = hash("whirlpool", $str);
				$query = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
		        $query->bindValue(1, $hashed, PDO::PARAM_STR);
		        $query->bindValue(2, $email, PDO::PARAM_STR);
		        $query->execute();

				$to = $email;
				$subject = "Snap New password";

				$message = "
					<html>
					<head>
						<title>".$subject."</title>
					</head>
					<body>
						<p> Hello your password is ".$str." </p><br>
						<a href='http://localhost:8080/camagru/login.php'>Click to continue</a>
					</body>
					</html>
				";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <noreply@wethinkcode.co.za>' . "\r\n";

				mail($to, $subject, $message, $headers);
				$_SESSION['error'] = 'Please check your email!';
				header("location:forgot.php");
				return;
			}
			else {
				$_SESSION['error'] = 'Email not found!';
				header("location:forgot.php");
				return;
			}
		}
	}
	else {
		$_SESSION['error'] = 'Check your email and try again!';
		header("location:forgot.php");
		return;
	}
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>
