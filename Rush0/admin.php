<?php
session_start();
header('Location: admin_page.php');
//$mysqli = new mysqli("e2r12p6:3306", "samy", "tititi", "DB");
$mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");

function ft_exist($name, $prods) {
	if (!$name || !$prods)
		return FALSE;
	while ($prd = mysqli_fetch_assoc($prods)) {
		if ($prd['name'] === $name) {
			//	echo ("<p>name ".$name." est compare avec ".$prd['name']."</p>");
			return TRUE; }
	}
	return FALSE;
}

if (isset($_POST['del_user']))
{	
	$login = mysqli_real_escape_string($mysqli, $_POST['del_user']);
	$query = "DELETE FROM Users WHERE login='".$login."'";
	//	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to delete user : ".$mysqli->error."\n");
		exit ();
	}
	if ($_SESSION['user'] == $_POST['del_user']) {
		$_SESSION['user'] = "";
		$_SESSION['permission'] = 'pigeon';
		$_SESSION['cart'] = "";
	}
}
else if (isset($_POST['res_cart']))
{	
	$login = mysqli_real_escape_string($mysqli, $_POST['res_cart']);
	$query = "DELETE FROM Carts WHERE login='".$login."'";
	//	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to reset cart (first step) : ".$mysqli->error."\n");
		exit ();
	}
}
else if (isset($_POST['grade_down']))
{	
	$login = mysqli_real_escape_string($mysqli, $_POST['grade_down']);
	$query = "UPDATE Users SET permission='pigeon' WHERE login='".$login."'";
	//	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to downgrade permission : ".$mysqli->error."\n");
		exit ();
	}
	if ($_SESSION['user'] == $_POST['grade_down']) {
		$_SESSION['permission'] = 'pigeon';
	}
}
else if (isset($_POST['grade_up']))
{	
	$login = mysqli_real_escape_string($mysqli, $_POST['grade_up']);
	$query = "UPDATE Users SET permission='admin' WHERE login='".$login."'";
	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to upgrade permission : ".$mysqli->error."\n");
		exit ();
	}
}
else if (isset($_POST['acces_cart']))
{	
	$login = mysqli_real_escape_string($mysqli, $_POST['acces_cart']);
	$query = "SELECT COUNT(login) FROM Carts WHERE login='".$login."'";
	$count = $mysqli->query($query);
	//	echo ("<p>login :".$login."</p>");
	if ($count !== 1 && $count !== 0) {
		echo ("Error, more than one cart with this name. ".$mysqli->error."\n");
		exit ();
	}
	else if ($count === 0) {
		$query = "INSERT INTO Carts (login) VALUES ('".$login."')";
		//	echo ("<p>login :".$login."</p>");
		if ($mysqli->query($query) === FALSE) {
			echo ("Error trying to create cart login : ".$mysqli->error."\n");
			exit ();
		}
	}
	$_SESSION['cart'] = $login;
}
else if (isset($_POST['submit']) && $_POST['submit'] === 'OK')
{
	$login = mysqli_real_escape_string($mysqli, $_POST['login_to_change']);
	$passwd = mysqli_real_escape_string($mysqli, $_POST['pwd_to_change']);
	$passwd = hash ('whirlpool', $passwd);
	$query = "UPDATE Users SET passwd='".$passwd."' WHERE login='".$login."'";
	//	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to delete user : " . $mysqli->error."\n");
		exit ();
	}
}
else if (isset($_POST['new_p']) && $_POST['new_p'] === 'OK')
{
	$query = "SELECT name FROM Products";
	if (($prods = $mysqli->query($query)) === FALSE) {
		echo ("Error trying to retrieve Products Table : " . $mysqli->error."\n");
		exit ();
	}
	$name = mysqli_real_escape_string($mysqli, $_POST['name_of_prod']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price_of_prod']); 
	$stock = mysqli_real_escape_string($mysqli, $_POST['stock']);
	$mate = mysqli_real_escape_string($mysqli, $_POST['quality']);
	if (ft_exist($name, $prods) === FALSE)
	{
		$query = "INSERT INTO Products (name, price, stock, mate) VALUES ('".$name."', ".$price.", ".$stock.", '".$mate."')";
		//	echo ("<p>login :".$login."</p>");
		if ($mysqli->query($query) === FALSE) {
			echo ("Error trying to add product : " . $mysqli->error."\n");
			exit ();
		}
	}
	else {
		if ($_POST['price_of_prod'])
		{
			$query = "UPDATE Products SET price='".$price."' WHERE name='".$name."'";
			//	echo ("<p>login :".$login."</p>");
			if ($mysqli->query($query) === FALSE) {
				echo ("Error trying to set price : " . $mysqli->error."\n");
				exit ();
			}
		}
		if ($_POST['stock'])
		{
			$query = "UPDATE Products SET stock='".$stock."' WHERE name='".$name."'";
			//	echo ("<p>login :".$login."</p>");
			if ($mysqli->query($query) === FALSE) {
				echo ("Error trying to set stock : " . $mysqli->error."\n");
				exit ();
			}
		}
		if ($_POST['quality'])
		{
			$query = "UPDATE Products SET quality='".$mate."' WHERE name='".$name."'";
			//	echo ("<p>login :".$login."</p>");
			if ($mysqli->query($query) === FALSE) {
				echo ("Error trying to set material/quality : " . $mysqli->error."\n");
				exit ();
			}
		}
	}
}
else if (isset($_POST['del_p']) && $_POST['del_p'] === 'OK')
{
	$name = mysqli_real_escape_string($mysqli, $_POST['name_of_prod']);
	$query = "DELETE FROM Products WHERE name='".$name."'";
	//	echo ("<p>login :".$login."</p>");
	if ($mysqli->query($query) === FALSE) {
		echo ("Error trying to delete product : ".$mysqli->error."\n");
		exit ();
	}
}
mysqli_close($mysqli);
?>
