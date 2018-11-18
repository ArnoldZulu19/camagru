<?php
session_start();
include_once 'config/database.php';

try {
	$img = $_GET['id'];
	$user = $_SESSION['username'];

	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$query4= $db->prepare("SELECT * FROM unlike WHERE img = :img AND username = :username");
    $query4->execute(array(':img'=> $img,':username' => $user));
    $count4 = $query4->rowCount();
    if ($count4 == 1) {
		header("location:views.php");
		return;
	}
	$query1 = $db->prepare("INSERT INTO unlike (img, username) VALUES (:img, :username)");
	$query1->execute(array(':img'=> $img, ':username'=> $user));
	header("location:views.php");
	return;
}
catch (PDOException $e) {
    echo $e->getMessage();
}