<?php
session_start();
include_once 'config/database.php';


try {

	$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$_SESSION['error'] = null;

	if (isset($_POST['signup'])) {

		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$hashed = hash("whirlpool", $password); 

		if (empty($email) || empty($username) || empty($password) || empty($cpassword)) {
			$_SESSION['error'] = 'fill in all blocks!';
			header("location:register.php");
			return;
		} 
		else {
			if ($password != $cpassword) {
				$_SESSION['error'] = 'Passwords dont Match!';
				header("location:register.php");
				return;
			}
			else {
				if (!preg_match("/^[a-zA-Z0-9]+/", $username)) {
				$_SESSION['error'] = 'Username must be alphabet or numbers, ONLY!';
				header("location:register.php");
				return;
			}
				else {
					if (strlen($password) < 5) {
					$_SESSION['error'] = 'Password must be 5 or more'.'<br>'.'characters long!';
					header("location:register.php");
					return;
				}
				else {
					if (!preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
						$_SESSION['error'] = 'Password must be alphabet with'.'<br>'.'atleast ONE uppercase letter';
						header("location:register.php");
						return;
						}
						else {
							if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								$_SESSION['error'] = 'Invalid Email';
								header("location:register.php");
								return;
							}
							else {
								$query = $db->prepare("SELECT * FROM users WHERE email = :email");
								$query->execute(array(':email' => $email));
								$count = $query->rowCount();
								if ($count > 0) {
									$_SESSION['error'] = 'User already exist'.'<br>'.'Choose another EMAIL!';
									header("location:register.php");
									return;
								}
								else { 

									$token = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
									$token = str_shuffle($token);
									$token = substr($token, 0, 10);

		/*------------------------------------------------- INSERTING user ----------------------------------------------------*/
							
									$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
									$query->execute(array(':email' => $email, ':username' => $username, ':password' => $hashed, ':isEmailConfirmed' => '0', ':token' => $token));

									$select = $db->prepare("SELECT * FROM users WHERE username = :username and email = :email");
									$select->execute(array(':username' => $username, ':email' => $email));
									$count = $select->rowCount();
									if ($count > 0) {
										while ($data = $select->fetch(PDO::FETCH_ASSOC)) {
											$db_id = $data['id'];
										}
										$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:db_id)");
										$query->execute(array(':db_id'=> $db_id));
										$query = $db->prepare("INSERT INTO email_notify (email, isNotify, isNotNotify) VALUES (:email, :isNotify, :isNotNotify)");
										$query->execute(array(':email'=> $email, ':isNotify' => '1', 'isNotNotify' => '0'));
									} else {
										$_SESSION['error'] = "table setup error";
										header("location:register.php");
										return;
									}
		/*----------------------------------------------- SEND CONFIRMATION MAIL-------------------------------------------------*/

									$to = $email;
									$subject = "Snap verification email";

									$message = "
									<html>
									<head>
									  <title>Snap verification email</title>
									</head>
									<body>
									<p> Hello ".$username." Please click on link to activate your account </p>
									<a href='http://localhost:8080/camagru/confirm.php?email=$email&token=$token'>Click Here</a>
									</body>
									</html>
									";

									$headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
									$headers .= 'From: <noreply@wethinkcode.co.za>' . "\r\n";

									mail($to, $subject, $message, $headers);
									$_SESSION['error'] = 'Check email before logging in!';
									header("location:register.php");
									return;
								}
							}
						}
					}
				}
			}
		}
	}	
	else{
		header("location:register.php");
		return;
	}
}
catch (PDOException $e) {
	echo $e->getMessage();
}
?>