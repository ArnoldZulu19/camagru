<?php
session_start();
include_once 'config/database.php';

$imgID = $_GET['id'];

try {
  $db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query= $db->prepare("DELETE FROM images WHERE id=:id AND user_id=:user_id");
  $query->execute(array(':id' => $imgID, ':user_id' => $_SESSION['uid']));
}
catch (PDOException $e) {
  echo $e->getMessage();
}
header('location:photo.php');