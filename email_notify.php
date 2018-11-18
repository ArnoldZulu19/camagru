<?php
session_start();
include_once 'config/database.php';

$ID = $_GET['id'];
$email = $_SESSION['email'];

try {
	$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  if ($ID == '1') {
  	$query = $db->prepare("UPDATE email_notify SET isNotify = ?, isNotNotify = ? WHERE email = ?");
	$query->bindValue(1, '1', PDO::PARAM_INT);
	$query->bindValue(2, '0', PDO::PARAM_INT);
	$query->bindValue(3, $email, PDO::PARAM_STR);
	$query->execute();
  }
  else if ($ID == '2') {
  	$query = $db->prepare("UPDATE email_notify SET isNotify = ?, isNotNotify = ? WHERE email = ?");
	$query->bindValue(1, '0', PDO::PARAM_INT);
	$query->bindValue(2, '1', PDO::PARAM_INT);
	$query->bindValue(3, $email, PDO::PARAM_STR);
	$query->execute();
  }
}
catch (PDOException $e) {
	echo $e->getMessage();
}
header("location:profile.php");