<?php 
include 'config/database.php';
?>

<header>
	<div id="home_header">
		<div id="home_title">
			<h1>Snap</h1>
		</div>
		<div class="home_links">
		<?php if(isset($_SESSION['uid'])) { ?>
			<div class="profImg">
			<?php
				try {
					$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$query = $db->prepare("SELECT * FROM profileImage WHERE user_id = {$_SESSION['uid']}");
					$query->execute();
					$dat = null;
					while ($res = $query->fetch()) {
						$dat['user_id'] = $res['user_id'];
					}
					echo "<img src='profilePics/".$dat['user_id'].".jpg' style='width:60px;height:60px;border-radius:30px;'>";
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
			?>
			</div>
			<div><a href="profile.php"><button class="home" style="color:cyan"><?php echo $_SESSION['username'];?></button></a></div>
			<div><a href="photo.php"><button class="home">edit</button></a></div>
			<div><a href="views.php"><button class="home">gallery</button></a></div>
			<div class="home_notif">
				<a href="#">notifications
				<?php 
				try {
					$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$query = $db->prepare("SELECT * FROM `comments` WHERE status = 'unread' order by date DESC");
					$query->execute();
					$count = $query->rowCount();
					if ($count > 0) { ?>
							<span style="background:pink;color:black;"><?php echo $count; ?></span>
					<?php } ?>
				</a>
				<div class="drop_box">
				<?php
					if ($count > 0) {
						$db_name = null;
						while ($data=$query->fetch()) {
							$db_name = $data['username']; ?>
							<a style="<?php if ('status' == 'unread') ?>" href="#">
							 	<?php echo "<strong>".$db_name."</strong>"." commented on a photo"; ?> 
							</a>
						<?php }
					} else {
						echo "No Notifications";
					}
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
				?>
				</div>
			</div>
			<div><a href="members.php"><button class="home">members</button></a></div>
			<div id="logout_link">
			<?php
				if(isset($_SESSION['username'])){
					echo '<div id="log">
							<form method="POST" action="logout.php">
								<input type="submit" name="logout" id="logout" value="Logout">
							</form>
						</div>';
				} else {
					header("location: login.php");
				}
			?>
			</div>
		</div>
	<?php } ?>
	</div>
</header>

<div class="top_top">