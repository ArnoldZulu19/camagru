<?php
session_start();
?>

<html>
<head>
	<title>forgot page</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>

<body>
<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<div id="index_body">
		<div id="signup_form">
		<div id="form_title"><h1>forgot</h1></div>
			<h3>
				<?php if($_SESSION['error']){ echo $_SESSION['error']; }
				$_SESSION['error'] = null;	?>
			</h3>
		<form method="POST" action="forgot_user.php">
			<input type="email" id="email" name="email" placeholder="Enter email"><br>
			<button type="submit" name="forgot" id="signup">Submit</button><br>
			<a href="register.php" class="forgotten">Not yet a member?</a>
			</form>
		</div>
	</div>
</body>

</html>