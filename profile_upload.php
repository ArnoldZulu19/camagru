<?php
session_start();
include_once 'config/database.php';

$_SESSION['err'] = null;
$_SESSION['error'] = null;

try {
    $db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['upload'])) {

        $file = $_FILES['img'];
        $name = $file['name'];
        $splitName = explode('.', $name);
        $takeLast = end($splitName);
        $lowerEnd = strtolower($takeLast);
        $comparedTo = array('jpeg', 'png', 'jpg');

        if (in_array($lowerEnd, $comparedTo) == false) {
            $_SESSION['err'] = "choose jpg, png or jpeg";
            header("location:profile.php");
            return;
        }

        else {
            $errors = $file['error'];
            if ($errors === 1) {
                $_SESSION['err'] = "errors encountered while uploading";
                header("location:profile.php");
                return;
            }
            else {
                $imgsize = $file['size'];
                if ($imgsize > 1000000) {
                    $_SESSION['err'] = "image size is too big";
                    header("location:profile.php");
                    return;
                }
                else {
                    if (!file_exists('profilePics')) {
                        mkdir('profilePics', 0755, true);
                    }
                    $tmpName = $file['tmp_name'];
                    $newName = $_SESSION['uid'].".jpg";
                    move_uploaded_file($tmpName, 'profilePics/'.$newName);
                    $query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
                    $query->execute(array(':user_id' => $_SESSION['uid'])); 
                    $_SESSION['err'] = 'Image Upload Sucessful';
                    header("location:profile.php");
                    return; 
                }
            }
        }
    }
    else if (isset($_POST['update'])) {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $passwordhash = hash("whirlpool", $password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid Email';
            header("location:profile.php");
            return; 
        }
        else {
            if (empty($password)) {
            $_SESSION['error'] = 'password cannot be empty';
            header("location:profile.php");
            return;
        }
         else {
            $query = $db->prepare("UPDATE users SET email = :email, username = :username, password = :password WHERE id = {$_SESSION['uid']} ");
            $query->execute(array(':email' => $email, 
                                    ':username' => $username, 
                                    ':password' => $passwordhash));
            $_SESSION['error'] = "User Info Updated sucessfully";
            header("location:profile.php");
            return; 
            }
        }
    }
    else {
        header("location:profile.php");
        return; 
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
}