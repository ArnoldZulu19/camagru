<?php 
session_start(); 
include 'config/database.php';
?>

<html>
<head>
	<title>home page</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
<body>
<?php if(isset($_SESSION['uid'])){ ?>
<?php include_once 'header.php'; ?>
	<div id="home_page_div">
 		<p class="hello_user"><?php echo 'Hi '. $_SESSION['username'] .'<br>'; ?></p>
 		<p class="edit"><?php echo 'Please edit your profile'.'<br>'; ?></p>
		<div id="home_main_page">
			<div class="home_profilePic">
				<?php
					try {
						$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$query = $db->prepare("SELECT * FROM `profileImage` WHERE user_id = '{$_SESSION['uid']}'");
						$query->execute();
						$data = null;
						while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
							$data['user_id'] = $res['user_id'];
						}
	                	echo "<img src='profilePics/".$data['user_id'].".jpg' style='width:300px;height:260px;'>";
                	}
					catch (PDOException $e) {
						echo $e->getMessage();
					}
				?>
			</div>
			<div class="home_upload">
				<h3>
					<?php if ($_SESSION['err']) { echo $_SESSION['err']; }
					$_SESSION['err'] = null; ?>
				</h3>	
				<form  action="profile_upload.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="img" id="img"><br><br>
					<input type="submit" name="upload" value="Upload" class="upload_submit">
				</form>
			</div>
			<div class="home_upload">
				<h3>
					<?php if($_SESSION['error']){ echo $_SESSION['error']; }
					$_SESSION['error'] = null;	?>
				</h3>
				<form method="POST" action="profile_upload.php">
					<input type="text" id="username" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username'];} else { echo 'Enter username';}?>"><br>
					<input type="email" id="email" name="email" value="<?php echo $_SESSION['email'];?>"><br>
					<input type="password" name="password" id="password" placeholder="Enter password"><br>
					<input type="password" name="cpassword" id="cpassword" placeholder="confirm password"><br>
					<button type="submit" name="update" class="upload_submit">Update</button><br>
				</form>
			</div>
		</div>
		<div class="noti_pref">
			<p>Do you want email Notifications?</p>
			<a href="email_notify.php?id=<?php echo '1'?>"><?php echo "<img src='images/up.png' style='width:20px;height:20px;pointer:cursor;'>"; ?></a>
          	<a href="email_notify.php?id=<?php echo '2'?>"><?php echo "<img src='images/down.png' style='width:20px;height:20px;margin-left:10px;pointer:cursor;'>"; ?></a>
		</div>
</div>
<?php include_once 'footer.php'; ?>
<?php } else { header("Location: login.php"); } ?>	
</body>
</html>