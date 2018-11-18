<?php
	session_start();
	include_once 'config/database.php';
?>

<html>
<head>
	<title>index</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
<body>
<header>
	<div id="home_header">
		<div id="home_title">
			<h1>Snap</h1>
		</div>
		<div class="reg">
		<div class="log_sign">
			<button class="sign"><a href="register.php">SignUp</a></button>
			<button class="log"><a href="login.php">Login</a></button>
		</div>
	</div>
</header>
<footer id="index_footer">Snap &copy azulu 2018</footer>
<div class="main">
	<div class="index_main_page">
	  <?php
	    try {
	        $ImgsPerPage = 5;
	        $page = '';
	        if (isset($_GET['page'])){
	          $page = $_GET['page'];
	        }
	        else {
	          $page = 1;
	        }
	        $start = ($page - 1) * $ImgsPerPage;
	        $db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
	        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $query = $db->prepare("SELECT * FROM images ORDER BY date DESC LIMIT ? , ?");
	        $query->bindValue(1, $start, PDO::PARAM_INT);
	        $query->bindValue(2, $ImgsPerPage, PDO::PARAM_INT);
	        $query->execute();
	        while ($data = $query->fetch()) {
	          echo "<div style='margin-left:100px;padding-top:10px;'>";
	          echo "<div style='margin:10px;margin-top:40px;'>";
	          echo "<div style='font-size:18px;padding-bottom:5px;font-family:sans-serif;'>";
	          echo "<strong>".$data['username']."</strong>"." posted an image on "."<em>".$data['date']."</em>";
	          echo "</div>";
	          echo "<img src=".$data['img'] ." style='padding-bottom:10px;'>"."<br>";
	          $run = $db->prepare("SELECT * FROM likes WHERE img = :img");
	          $run->execute(array(':img'=> $data['img']));
	          if ($run->rowCount() > 0) {
	            while ($r = $run->fetch()) {
	              echo "<div style='padding-left:5px;font-size:16px;font-family:sans-serif;'>";
	              echo "<strong>".$r['username']."</strong>"." liked this image.<br>";
	              echo "</div>";
	            }
	          } else {
	            echo "";
	          }
	          $runData = $db->prepare("SELECT * FROM unlike WHERE img = :img");
	          $runData->execute(array(':img'=> $data['img']));
	          if ($runData->rowCount() > 0) {
	            while ($ro = $runData->fetch()) {
	              echo "<div style='padding-left:5px;font-size:16px;font-family:sans-serif;'>";
	              echo "<strong>".$ro['username']."</strong>"." unliked this image. <br>";
	              echo "</div>";
	            }
	          } else {
	            echo "";
	          }
	          $stmt = $db->prepare("SELECT * FROM `comments` WHERE img = :img");
	          $stmt->execute(array(':img' => $data['img']));
	          if ($stmt->rowCount() > 0) {
	            while ($row = $stmt->fetch()) {
	              echo "<div style='padding-left:5px;font-size:16px;font-family:sans-serif;'>";
	              echo "<strong>".$row['username']."</strong>".": ".$row['comment']."<br>";
	              echo "</div>";
	            }
	          } else {
	            echo "";
	          }
	          ?>
	          <?php
	          echo "</div>";
	          echo "</div>";
	        }
	      }
	      catch (PDOException $e) {
	        return ($e->getMessage());
	      }
	    ?>
	    <div>
		     <?php
		        $stmt = $db->prepare("SELECT * FROM images ORDER BY date");
		        $stmt->execute();
		        $total_imgs = $stmt->rowCount();
		        $num_of_pages = ceil($total_imgs/$ImgsPerPage);
		        for ($i = 1; $i <= $num_of_pages; $i++) {
		          echo "<a href='index.php?page=".$i."'style='margin-left:30px;text-decoration:none;font-size:20px;'>".$i."</a>";
		        }
		    ?>
    	</div>
	</div>
<div>
</body>
</html>