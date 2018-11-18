<?php
session_start();
include_once 'config/database.php';
?>

<html>
<head>
	<title>gallery</title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>

<body>
<?php if (isset($_SESSION['uid'])) { ?>
<?php include_once 'header.php'; ?>
	<div class="views_main_page">
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
          echo "<img src=".$data['img'] ." style='padding-bottom:10px;'>"."<br>"; ?>
          <a href="likes.php?id=<?php echo $data['img']?>"><?php echo "<img src='images/up.png' style='width:20px;height:20px;padding-bottom:5px;'>"; ?></a>
          <a href="unlike.php?id=<?php echo $data['img']?>"><?php echo "<img src='images/down.png' style='width:20px;height:20px;margin-left:10px;padding-bottom:5px;'>"; ?></a> <?php
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
          echo "<form method='POST' action='comments.php'>
                <input type='hidden' name='mail' value='{$data["email"]}'>
                <input type='hidden' name='img' value='{$data["img"]}'>
                <textarea name='komment' row='50' cols='52' placeholder='Write a comment.......'></textarea><br>
                <button type='submit' name='comment' style='background:rgba(0, 0, 0, 0.3);padding:5px;width:30%;cursor:pointer;'>comment</button>
              </form>";
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
          echo "<a href='views.php?page=".$i."'style='margin-left:30px;text-decoration:none;font-size:20px;'>".$i."</a>";
        }
      ?>
    </div>
	</div>
<?php include_once 'footer.php'; ?>
<?php } else { header("Location: login.php"); } ?>
</body>
</html>