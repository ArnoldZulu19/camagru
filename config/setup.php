<?php

include_once 'database.php';

/*------------------------------------------------- create Database --------------------------------------------------------------------------------------------------------------------------------------------*/

try {
	$db = new PDO ($DB_DSN_N, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	$db->exec("Drop DATABASE IF EXISTS camagru;");
    $db->exec("CREATE DATABASE IF NOT EXISTS camagru;");
}
catch (PDOException $e) {
	echo $e->getMessage();
}

/*------------------------------------------------------ create Tables -----------------------------------------------------------------------------------------------------------------------------------------*/
try {
	$db = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = "CREATE TABLE users (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, email VARCHAR(100) NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, isEmailConfirmed INT(1) NOT NULL, token VARCHAR(10) NOT NULL);";
	$db->exec($query);

/*---------------------------------------------------- images Table -----------------------------------------------*/

	$query = "CREATE TABLE images (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, img VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, user_id INT(9) NOT NULL, date TIMESTAMP);";
	$db->exec($query);

/*---------------------------------------------------- profileImage Table -----------------------------------------------*/

	$query = "CREATE TABLE profileImage (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, user_id INT(9) NOT NULL);";
	$db->exec($query);

/*---------------------------------------------------- likes Table -----------------------------------------------*/

	$query = "CREATE TABLE likes (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, img VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL);";
	$db->exec($query);

/*---------------------------------------------------- unlike Table -----------------------------------------------*/

	$query = "CREATE TABLE unlike (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, img VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL);";
	$db->exec($query);
/*---------------------------------------------------- comments Table -----------------------------------------------*/

	$query = "CREATE TABLE comments (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, status TEXT NOT NULL, comment TEXT NOT NULL, img VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, date TIMESTAMP);";
	$db->exec($query);
/*---------------------------------------------------- notification option table -----------------------------------------------*/

	$query = "CREATE TABLE email_notify (id INT(9) AUTO_INCREMENT PRIMARY KEY NOT NULL, email VARCHAR(100) NOT NULL, isNotify INT(1) NOT NULL, isNotNotify INT(1) NOT NULL);";
	$db->exec($query);

/*---------------------------------------------------- insert users -----------------------------------------------*/


	$user1_email = 'skott.anola@gmail.com';
	$user1_username = 'skott';
	$user1_password = hash('whirlpool', 'sdfghjk;lkjhgf4567890rtyjkl0987654');
	$user1_isEmailConfirmed = 0;
	$user1_token = '';
	$user1_user_id = 1;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user1_email, ':username' => $user1_username, ':password' => $user1_password, ':isEmailConfirmed' => $user1_isEmailConfirmed, ':token' => $user1_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user1_user_id));

	$user2_email = 'alfred.123@gmail.com';
	$user2_username = 'alfred';
	$user2_password = hash('whirlpool', '#ERR%T%GYYGHHJJBBbhhgghfjfjfiriiu4u4urhrhjrjr');
	$user2_isEmailConfirmed = 0;
	$user2_token = '';
	$user2_user_id = 2;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user2_email, ':username' => $user2_username, ':password' => $user2_password, ':isEmailConfirmed' => $user2_isEmailConfirmed, ':token' => $user2_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user2_user_id));

	$user3_email = 'sam.smith@facebook.com';
	$user3_username = 'sammy';
	$user3_password = hash('whirlpool', 'i96i696ijjvhvngjghckslsskazaas@!%$FFFFf');
	$user3_isEmailConfirmed = 0;
	$user3_token = '';
	$user3_user_id = 3;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user3_email, ':username' => $user3_username, ':password' => $user3_password, ':isEmailConfirmed' => $user3_isEmailConfirmed, ':token' => $user3_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user3_user_id));

	$user4_email = 'sihle.m00@gmail.com';
	$user4_username = 'sihleM';
	$user4_password = hash('whirlpool', 'oritijgmfmio545454j5tktkg@#!#$$jkkkluikl');
	$user4_isEmailConfirmed = 0;
	$user4_token = '';
	$user4_user_id = 4;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user4_email, ':username' => $user4_username, ':password' => $user4_password, ':isEmailConfirmed' => $user4_isEmailConfirmed, ':token' => $user4_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user4_user_id));

	$user5_email = 'mini.ntuli42@gmail.com';
	$user5_username = 'miniMe';
	$user5_password = hash('whirlpool', 'huerhgwmtwnnvwnjmvim8998gnu5t89nuv289bnbvunuvnv');
	$user5_isEmailConfirmed = 0;
	$user5_token = '';
	$user5_user_id = 5;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user5_email, ':username' => $user5_username, ':password' => $user5_password, ':isEmailConfirmed' => $user5_isEmailConfirmed, ':token' => $user5_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user5_user_id));

	$user6_email = 'ringo.mda1932@webmail.com';
	$user6_username = 'rmdaaah';
	$user6_password = hash('whirlpool', 'r&&&%ijehjejeiejejej8857585jjfnfjfirurnriurrnf');
	$user6_isEmailConfirmed = 0;
	$user6_token = '';
	$user6_user_id = 6;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user6_email, ':username' => $user6_username, ':password' => $user6_password, ':isEmailConfirmed' => $user6_isEmailConfirmed, ':token' => $user6_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user6_user_id));

	$user7_email = 'michaelsibiya05@gmail.com';
	$user7_username = 'msibiya';
	$user7_password = hash('whirlpool', 'sdgf85959jyuiojvklnmklptjgngnggmfIIJktitirrnfjfkf');
	$user7_isEmailConfirmed = 0;
	$user7_token = '';
	$user7_user_id = 7;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user7_email, ':username' => $user7_username, ':password' => $user7_password, ':isEmailConfirmed' => $user7_isEmailConfirmed, ':token' => $user7_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user7_user_id));

	$user8_email = 'jimmyDludlu@gmail.com';
	$user8_username = 'terminator';
	$user8_password = hash('whirlpool', 'hdjdjdbdbdjd89#ERR%T%GYYGHHJJBBbhhgghfjfjfiriiu4u4urhrhjrjr');
	$user8_isEmailConfirmed = 0;
	$user8_token = '';
	$user8_user_id = 8;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user8_email, ':username' => $user8_username, ':password' => $user8_password, ':isEmailConfirmed' => $user8_isEmailConfirmed, ':token' => $user8_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user8_user_id));

	$user9_email = 'ntando.gumede@yahoo.com';
	$user9_username = 'jovisG';
	$user9_password = hash('whirlpool', 'i9ohkykhkhmgk6i696ijjvhvngjghckslsskazaas@!%$FFFFf');
	$user9_isEmailConfirmed = 0;
	$user9_token = '';
	$user9_user_id = 9;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user9_email, ':username' => $user9_username, ':password' => $user9_password, ':isEmailConfirmed' => $user9_isEmailConfirmed, ':token' => $user9_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user9_user_id));

	$user10_email = 'charleszyan.m00@kmt.com';
	$user10_username = 'zyanBoy';
	$user10_password = hash('whirlpool', 'KKKjfjfkjcfkfkf9988oritijgmfmio545454j5tktkg@#!#$$jkkkluikl');
	$user10_isEmailConfirmed = 0;
	$user10_token = '';
	$user10_user_id = 10;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user10_email, ':username' => $user10_username, ':password' => $user10_password, ':isEmailConfirmed' => $user10_isEmailConfirmed, ':token' => $user10_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user10_user_id));

	$user11_email = 'thabo.m@wethinkcode.com';
	$user11_username = 'tbose';
	$user11_password = hash('whirlpool', '6464#huerhgwmtwnnvwnjmvim8998gnu5t89nuv289bnbvunuvnv');
	$user11_isEmailConfirmed = 0;
	$user11_token = '';
	$user11_user_id = 11;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user11_email, ':username' => $user11_username, ':password' => $user11_password, ':isEmailConfirmed' => $user11_isEmailConfirmed, ':token' => $user11_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user11_user_id));

	$user12_email = 'buhlebendalo.Bee@webmail.com';
	$user12_username = 'buhleBee';
	$user12_password = hash('whirlpool', '89994hfhfjfjfr&&&%ijehjejeiejejej8857585jjfnfjfirurnriurrnf');
	$user12_isEmailConfirmed = 0;
	$user12_token = '';
	$user12_user_id = 12;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user12_email, ':username' => $user12_username, ':password' => $user12_password, ':isEmailConfirmed' => $user12_isEmailConfirmed, ':token' => $user12_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user12_user_id));

	$user13_email = 'khayakheswa.989@gmail.com';
	$user13_username = 'kaykay';
	$user13_password = hash('whirlpool', 'dfghjkujnbvbnmlkmn$85959jtjgngnggmfIIJktitirrnfjfkf');
	$user13_isEmailConfirmed = 0;
	$user13_token = '';
	$user13_user_id = 13;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user13_email, ':username' => $user13_username, ':password' => $user13_password, ':isEmailConfirmed' => $user13_isEmailConfirmed, ':token' => $user13_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user13_user_id));

	$user14_email = 'Disemelo.dc@facebook.com';
	$user14_username = 'deecee';
	$user14_password = hash('whirlpool', '898y5#Eu8y8hrrrhfkeirururRR%T%GYYGHHJJBBbhhgghfjfjfiriiu4u4urhrhjrjr');
	$user14_isEmailConfirmed = 0;
	$user14_token = '';
	$user14_user_id = 14;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user14_email, ':username' => $user14_username, ':password' => $user14_password, ':isEmailConfirmed' => $user14_isEmailConfirmed, ':token' => $user14_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user14_user_id));

	$user15_email = 'jon.Cee@webmail.com';
	$user15_username = 'jonCee';
	$user15_password = hash('whirlpool', '456789098tghi96i696ijjvhvngjghckslsskazaas@!%$FFFFf');
	$user15_isEmailConfirmed = 0;
	$user15_token = '';
	$user15_user_id = 15;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user15_email, ':username' => $user15_username, ':password' => $user15_password, ':isEmailConfirmed' => $user15_isEmailConfirmed, ':token' => $user15_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user15_user_id));

	$user16_email = 'nkosi.nathi2017@gmail.com';
	$user16_username = 'nkosiN';
	$user16_password = hash('whirlpool', 'tyui6789oritijgmfmio545454j5tktkg@#!#$$jkkkluikl');
	$user16_isEmailConfirmed = 0;
	$user16_token = '';
	$user16_user_id = 16;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user16_email, ':username' => $user16_username, ':password' => $user16_password, ':isEmailConfirmed' => $user16_isEmailConfirmed, ':token' => $user16_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user16_user_id));

	$user17_email = 'clementine.mimi@gmail.com';
	$user17_username = 'clemmy';
	$user17_password = hash('whirlpool', 'huerhgwmtwn567890nvwnjmvim8998gnu5t809879nuv289bnbvunuvnv');
	$user17_isEmailConfirmed = 0;
	$user17_token = '';
	$user17_user_id = 17;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user17_email, ':username' => $user17_username, ':password' => $user17_password, ':isEmailConfirmed' => $user17_isEmailConfirmed, ':token' => $user17_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user17_user_id));

	$user18_email = 'star.arnold@webmail.co.za';
	$user18_username = 'starArnold';
	$user18_password = hash('whirlpool', 'AYT%%098767898r&&&%ijehjejeiejejej8857585jjfnfjfirurnriurrnf');
	$user18_isEmailConfirmed = 0;
	$user18_token = '';
	$user18_user_id = 18;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user18_email, ':username' => $user18_username, ':password' => $user18_password, ':isEmailConfirmed' => $user18_isEmailConfirmed, ':token' => $user18_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user18_user_id));

	$user19_email = 'mishack.01@gmail.com';
	$user19_username = 'sparkz';
	$user19_password = hash('whirlpool', 'sdg56789098vbnm5959jyuiojvklnmklptjgngnggmfIIJktitirrnfjfkf');
	$user19_isEmailConfirmed = 0;
	$user19_token = '';
	$user19_user_id = 19;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user19_email, ':username' => $user19_username, ':password' => $user19_password, ':isEmailConfirmed' => $user19_isEmailConfirmed, ':token' => $user19_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user19_user_id));

	$user20_email = 'kellyK@wethinkcode.com';
	$user20_username = 'kelly';
	$user20_password = hash('whirlpool', 'hdjdj5678dbdbdjd89#ERR%T%GYYGHHJJBBbhhgghfjfjfiriiu4u4urhrhjrjr');
	$user20_isEmailConfirmed = 0;
	$user20_token = '';
	$user20_user_id = 20;
	$query = $db->prepare("INSERT INTO users (email, username, password, isEmailConfirmed, token) VALUES (:email, :username, :password, :isEmailConfirmed, :token)");
	$query->execute(array(':email' => $user20_email, ':username' => $user20_username, ':password' => $user20_password, ':isEmailConfirmed' => $user20_isEmailConfirmed, ':token' => $user20_token));
	$query = $db->prepare("INSERT INTO profileImage (user_id) VALUES (:user_id)");
	$query->execute(array(':user_id'=> $user20_user_id));

	echo "OK!!! <br><br>";
	?>
	<html>
	<body>
		<a href="../index.php"><button style="padding: 10px;background: orange;">CLICK ME!!</button></a>
	</body>
	</html>
	<?php
}
catch (PDOException $e) {
	echo $e->getMessage();
}