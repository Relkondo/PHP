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
//$mysqli = new mysqli("e2r12p6:3306", "samy", "tititi", "DB");
$mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");

if (isset($_POST['val_p']) && $_POST['val_p'] === "valider")
{	
	$login = $_SESSION('user');
	$query = "SELECT login FROM Carts";
	if (($carts = $mysqli->query($query)) === FALSE) {
		echo ("Error trying to retrieve Carts : " . $mysqli->error."\n");
		exit ();
	}
	$query = "SELECT name, price, stock FROM Products";
	if (($product = $mysqli->query($query)) === FALSE) {
		echo ("Error trying to retriev  Product : " . $mysqli->error."\n");
		exit ();
	}
	while ($item = mysqli_fetch_assoc($product)) {
		$prod = $item['name'];
		$query = "UPDATE Carts SET price='".$price."' WHERE name='".$name."'";
		if ($mysqli->query($query) === FALSE) {
			echo ("Error trying to set price : " . $mysqli->error."\n");
			exit ();
		}
		}
	}
}

mysqli_close($mysqli);
?>
