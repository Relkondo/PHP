<?php

function ft_exist($login, $users) {
	if (!$login || !$users)
		return FALSE;
	while ($usr = mysqli_fetch_assoc($users)) {
		if ($usr['login'] === $login) {
		//	echo ("<p>login ".$login." est compare avec ".$usr['login']."</p>");
			return TRUE; }
	}
	return FALSE;
}

session_start();

if (isset($_POST['submit']) && $_POST['submit'] === "Register")
{	
	$mysqli = new mysqli("e2r12p6:3306", "samy", "tititi", "DB");
	//$mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");
	$query = "SELECT login FROM Users";
	if (($users = $mysqli->query($query)) === FALSE) {
		echo ("Error trying to retrieve Users Table : " . $mysqli->error."\n");
		exit ();
	}
	$login = mysqli_real_escape_string($mysqli, $_POST['login']);
	$passwd = hash ('whirlpool', mysqli_real_escape_string($mysqli, $_POST['passwd']));

	if ($_POST['passwd'] === $_POST['re-passwd'] && ft_exist($login, $users) === FALSE) {
		$query = "INSERT INTO Users (login, passwd, permission) VALUES ('".$login."', '".$passwd."', 'pigeon')";
		//	echo ("<p>login and passwd :".$login.", ".$passwd."</p>");
		if ($mysqli->query($query) === FALSE) {
			echo ("Error trying to create user : " . $mysqli->error."\n");
			exit ();
		}
		$query = "INSERT INTO Carts (login) VALUES ('".$login."')";
		if ($mysqli->query($query) === FALSE) {
			echo ("Error trying to create cart for user : " . $mysqli->error."\n");
			exit ();
		}
		$_SESSION['user'] = $_POST['login'];
		$_SESSION['permission'] = 'pigeon';
		$_SESSION['cart'] = $_POST['login'];
		header('Location: index.php');
	}
	else {
		$_SESSION['login_failure'] = TRUE;
		header('Location: register_page.php');
	}
	mysqli_close($mysqli);
}
?>
