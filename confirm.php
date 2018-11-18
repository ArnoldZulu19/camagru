<?php 

include_once 'config/database.php';

try{

	$email = $_GET["email"];
	$token = $_GET["token"];

	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
		$query = $db->prepare("SELECT * FROM users WHERE email= :email AND token = :token");
		$query->execute(array(':email' => $email, ':token' => $token));
		$count = $query->rowCount();

		if ($count == 1) {

			$query = $db->prepare("UPDATE users SET isEmailConfirmed = ?, token = ? WHERE email = ?");
	        $query->bindValue(1, '1', PDO::PARAM_INT);
	        $query->bindValue(2, ' ', PDO::PARAM_STR);
	        $query->bindValue(3, $email, PDO::PARAM_STR);
	        $query->execute();
			header("location: login.php");
			return;
		}
		header("location: register.php");
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>