<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>members page</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>

<body>
<?php if (isset($_SESSION['uid'])) { ?>
<?php include_once 'header.php'; ?>
<div class="member_profile"> 
	<?php
		try {
			include_once 'config/database.php';
			$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
			$query = $db->prepare("SELECT * FROM `users`");
			$query->execute();
			while ($row = $query->fetch()) {
				$stmt = $db->prepare("SELECT * FROM `profileImage` WHERE user_id={$row['id']}");
				$stmt->execute();
				while ($res = $stmt->fetch()) {
					$id = $res['user_id'];
					if ($_SESSION['uid'] != $id) {
						echo "<div style='margin:10px;background:rgba(0, 0, 0, 0.3);'>";
						echo "<p style='font-size:18px;padding-top:10px;font-family:sans-serif;text-align:center;'>"?><?php echo $row['username'].'<br>';"</p>";
						echo "<img src='profilePics/".$res['user_id'].".jpg' style='width:230px;height:200px;padding-left:20px;padding-right:20px;padding-top:10px;padding-bottom:10px;'>"."<br>";
						echo "<div style='font-size:18px;font-family:sans-serif;text-align:center;padding-bottom:20px;'>";
						?><a href='user.php?id=<?php echo $id?>' style='text-decoration:none;'><?php echo "<button  style='font-size:18px;cursor:pointer;background:rgba(0, 0, 0, 0.3);font-family:sans-serif;padding:3px;border-radius:3px;'>view profile</button>"?></a>
						<?php echo "</div>";
						echo "</div>";
					} else {
						echo "";
					}
				}
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	?>
</div>
<?php include_once 'footer.php'; ?>
<?php } else {  header("Location: login.php"); } ?>
</div>
</body>
</html>