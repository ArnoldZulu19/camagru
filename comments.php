<?php
session_start();
include_once 'config/database.php';

try { 

	if (isset($_POST['comment'])) {
		
		$image = $_POST['img'];
		$mail = $_POST['mail'];
		$komment = htmlentities($_POST['komment'], ENT_QUOTES, "UTF-8");
		$username = $_SESSION['username'];
		
		if (!empty($komment)) {

			$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $db->prepare("INSERT INTO comments (status, comment, img, username) VALUES (:status, :comment, :img, :username)");
			$query->execute(array(':status' => 'unread', ':comment' => $komment, ':img' => $image, ':username' => $username));
		
/*----------------------------------------------- SEND COMMENT MAIL-------------------------------------------------*/
		
			$stmt = $db->prepare("SELECT * FROM email_notify WHERE email = :email");
          	$stmt->execute(array(':email'=> $_SESSION['email']));
			//$data = null;
			while ($res = $stmt->fetch()) {
				$data = $res['isNotify'];
			}
			if ($data == 1) {
				$to = $mail;
				$subject = "Snap New comment";

				$message = "
				<html>
				<head>
					<title>".$subject."</title>
				</head>
				<body>
					<p> Hello <br>".$username." just commented on one of your images on Snap<br></p>
				</body>
				</html>
				";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <noreply@wethinkcode.co.za>' . "\r\n";
				mail($to, $subject, $message, $headers);
			}
		}
	}
	header("location:views.php");
	return;
}
catch (PDOException $e) {
	echo $e->getMessage();
}