<?php

session_start();

try {

	if (!file_exists('taken_images')) {
		mkdir('taken_images', 0755, true);
	}
	
  	$img1 = $_POST['img'];
  	$img1 = str_replace('data:image/png;base64,', '', $img1);
	$img1 = str_replace(' ', '+', $img1);
	$img1 = base64_decode($img1);
	$img1 = imagecreatefromstring($img1);
	
	$img2 = $_POST['sel'];
	$img2 = str_replace('data:image/png;base64,', '', $img2);
	$img2 = str_replace(' ', '+', $img2);
	$img2 = base64_decode($img2);
	$img2 = imagecreatefromstring($img2);
	
	$token = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$token = str_shuffle($token);
	$token = substr($token, 0, 8);
	$file = "taken_images/" . $token . '.png';
	imagecopy($img2, $img1);
	imagepng($img2, $file);

	include_once 'config/database.php';
	$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
  	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$query = $db->prepare("INSERT INTO images (img, username, email, user_id) VALUES (:img, :username, :email, :user_id)");
	$query->execute(array(':img' => $file, ':username' => $_SESSION['username'], ':email' => $_SESSION['email'], ':user_id' => $_SESSION['uid']));
}
catch (PDOException $e) {
	echo $e->getMessage();
}