<?php
session_start();
include_once 'config/database.php';
?>

<html>
<head>
	<title>edit</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>

<body>
<?php if (isset($_SESSION['uid'])) { ?>
<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<div class="gallery_main">
	<div class="gallery_left">
		<div class="gallery_top">
			<form>
				  <input type="radio" name="img" value='images/glasses0.png'>
				  <?php  echo "<img src='images/glasses0.png' style='width:100px;height:80px;'>"; ?>
				  <input type="radio" name="img" value='images/7.png'>
				  <?php  echo "<img src='images/7.png' style='width:100px;height:80px;'>"; ?>
				  <input type="radio" name="img" value='images/frame0.png'>
				  <?php  echo "<img src='images/frame0.png' style='width:100px;height:80px;'>"; ?>
			</form>
		</div>
		<div class="gallery_bottom">
			<video  id="video" class="video" autoplay></video>
			<div id="no_camera" class="no_camera">Ooops NO CAMERA</div>
			<button id="webcam_button" class="capture_img">Capture</button>
			<canvas class="canvas" id="canvas" width="380" height="300" style="display:none"></canvas>
			<button name="img_but" id="image_button" class="capture_img">Capture</button>
			<img id="photo">
			<input type="file" style="display:block" id="upload" accept="image/*">
		</div>
	</div>
	<div class="gallery_right">
		<div class="preview">Preview</div>
		<div id="display">
		<?php
		
			try {
				$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$query = $db->prepare("SELECT * FROM images WHERE user_id = {$_SESSION['uid']}");
				$query->execute();
				while ($data = $query->fetch()) { ?>
					<a href="deleteImage.php?id=<?php echo $data['id']?>"><?php echo "<img src=".$data['img'] ." style='padding-bottom:10px;'>"; ?></a>
				<?php }
			}
			catch (PDOException $e) {
				return ($e->getMessage());
			}
		?>
		</div>
	</div>
</div>
<?php } else { header("Location: login.php"); } ?>
</body>
<script src='photo.js'></script>
</html>