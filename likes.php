<?php
session_start();
include_once 'config/database.php';

try {
	$img = $_GET['id'];
	$user = $_SESSION['username'];
	
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$query2= $db->prepare("SELECT * FROM likes WHERE img = :img AND username = :username");
    $query2->execute(array(':img'=> $img,':username' => $user));
    $count2 = $query2->rowCount();
    if ($count2 == 1) {
		header("location:views.php");
		return;
	}
	$query1 = $db->prepare("INSERT INTO likes (img, username) VALUES (:img, :username)");
	$query1->execute(array(':img'=> $img, ':username'=> $user));
	header("location:views.php");
	return;
}
catch (PDOException $e) {
    echo $e->getMessage();
}