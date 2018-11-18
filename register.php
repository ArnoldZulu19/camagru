<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
    <title>register page</title>
</head>
<body>
<?php include 'header.php'; ?>
<div id="index_body">
    <div id="signup_form">
        <div id="form_title"><h1>Register</h1></div>
        <h3>
            <?php if ($_SESSION['error']) { echo $_SESSION['error']; }
            $_SESSION['error'] = null; ?>
        </h3>
        <form method="POST" action="register_signup.php">
            <input type="text" id="username" name="username" placeholder="Enter username"><br>
            <input type="email" id="email" name="email" placeholder="Enter email"><br>
            <input type="password" name="password" id="password" placeholder="Enter password"><br>
            <input type="password" name="cpassword" id="cpassword" placeholder="confirm password"><br>
            <button type="submit" name="signup" id="signup">Sign Up</button><br>
            <div id="anchors">
                <a href="login.php" class="forgotten">already a member?</a>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>

