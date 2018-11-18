<?php
session_start();
?>

<html>
<head>
	<title>login page</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>

<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>

<body>
	<div id="index_body">
			<div id="signup_form">
			<div id="form_title"><h1>Login</h1></div>
				<h3>
					<?php if($_SESSION['error']){ echo $_SESSION['error']; }
					$_SESSION['error'] = null;	?>
				</h3>
			<form method="POST" action="login_user.php">
				<input type="text" id="username" name="username" placeholder="Enter username"><br>
				<input type="password" name="password" id="password" placeholder="Enter password"><br>
				<button type="submit" name="login" id="signup">login</button><br>
				<div id="anchors">
				<a href="forgot.php" class="forgotten">forgot password?</a>
				<a href="register.php" class="logen">Not yet a member?</a>
				</div>
			</form>
			</div>
	</div>
</body>

</html>