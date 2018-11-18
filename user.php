<?php
session_start();
include_once 'config/database.php';
?>
<html>
<head>
	<title>user profile</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
<body>
<?php if(isset($_SESSION['uid'])) { ?>
<?php include_once 'header.php'; ?> 
 	<div id="home_page_div_go">	
	     <div id="home_main_page">
			<div class="home_profilePic">
			<?php
				try {
					$ID = htmlentities($_GET['id']);
				    $db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
				    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    $query= $db->prepare("SELECT * FROM users WHERE id=:id");
				    $query->execute(array(':id' => $ID));

				      while ($res = $query->fetch()) {
				      		$id = $res['id'];
				      		$user = $res['username'];
				      		$mail = $res['email'];
				      }
                	echo "<img src='profilePics/".$id.".jpg' style='width:300px;height:260px;'>";
                }
                catch (PDOException $e) {
				    echo $e->getMessage();
				}
			?>
			</div>
			<div class="home_upload">
					<p class='userName'><?php echo 'username: '. $user;?></p>
					<p class='userEmail'><?php echo 'email: '. $mail;?></p>
					<?php if ($_SESSION['uid'] != $id) {
						echo "<button type='submit' style='font-size:15px;padding:5px;margin-right:5px;margin-top:5px;border-radius:5px;width:30%;cursor:pointer;'>Like</button>";
						echo "<button type='submit' style='font-size:15px;padding:5px;margin-right:5px;margin-top:5px;border-radius:5px;width:30%;cursor:pointer;'>Chat</button>";
						echo "<button type='submit' style='font-size:15px;padding:5px;margin-right:5px;margin-top:5px;border-radius:5px;width:30%;cursor:pointer;'>Report</button>";
						} else {
							echo "";
						}
					?>
			</div>	
		</div>
		<div class="goBtn">
			<button class="goBack"><a href="members.php">Go Back</a></button>
		</div>
	</div>	
<?php include_once 'footer.php'; ?>
<?php } else { header("Location: login.php"); } ?>
</body>
</html>