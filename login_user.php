<?php
session_start();
include_once 'config/database.php';

$_SESSION['error'] = null;

try{
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = hash("whirlpool", $password);

		if (empty($username) || empty($password)) {
			$_SESSION['error'] = 'fill in all blocks!';
			header("location:login.php");
			return;
		}

		$query = $db->prepare("SELECT * FROM users WHERE username = ? and password = ? and isEmailConfirmed=?");
		$query->bindValue(1, $username, PDO::PARAM_STR);
		$query->bindValue(2, $password, PDO::PARAM_STR);
		$query->bindValue(3, '1', PDO::PARAM_INT);
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();
		$data = $query->fetch();

		if ($data['username'] != $username and $data['password'] != $password) {
			$_SESSION['error'] = 'Please check your inputs OR confirm email';
			header("location:login.php?");
			return;
		}

		else if ($data['username'] == $username and $data['password'] == $password) {
			$_SESSION['uid'] = $data['id'];
			$_SESSION['firstname'] = $data['firstname'];
			$_SESSION['lastname'] = $data['lastname'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['email'] = $data['email'];

			header("location:photo.php");
			return;
		}
	}
	else{
		header("location:login.php");
		return;
	}
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>