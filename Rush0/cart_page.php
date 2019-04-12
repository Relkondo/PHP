<?php
include('header.php'); 
//$mysqli = new mysqli("e2r12p6:3306", "samy", "tititi", "DB");
$mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");

/*
Users : login passwd permission
Carts : login hache1 hache2 hache3
Products : price name stock mate */
/*
$query = "SELECT name, price, stock FROM Producs";
$product = $mysqli->query($query);
while ($usr = mysqli_fetch_assoc($product))
{
	echo "<p>nom<p>
	echo "<img src="">
}
 */

?>
<html class="prettybody">
	<head>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
	<div class="container">
	<h1 style="text-align: left">Mon panier</h1>
<?php
if ($_SESSION['total']) {
?>

<table class="basket">
				<thead>
				<tr>
					<td>Nom</td>
					<td class="right">Prix</td>
					<td class="right">Quantité</td>
				</tr>
				</thead>
				<tbody>
<?php

	foreach ($_SESSION['prod'] as $key => $val) {
		$query = "SELECT price FROM Products WHERE name='".$key."'";
		if (($result = $mysqli->query($query)) === FALSE) {
			echo ("Error trying to retrieve price for product : " . $mysqli->error."\n");
			exit ();
		}
		$tmp = mysqli_fetch_assoc($result);
		$price = $tmp['price'];

?>
				<tr>
				<td><?php echo $key; ?></td>
				<td class="right"><?php echo $price; ?></td>
				<td class="right"><?php echo $val; ?></td>
				</tr>
<?php

	}

?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="5"></td>
					<td class="right"><?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0.00'; ?>€</td>
				</tr>
				</tfoot>
			</table>
<?PHP
if (isset ($_SESSION['user']))
{
	echo "<form method=\"post\" action=\"cart.php\">";
	echo "<input type=\"submit\" name=\"val_p\" value=\"valider\">";
	echo "</form>";
}
else
	echo "<p>You need to be log to proceed</p>"; 

?>
	</div>
	</body>
</html>

<?php
}
mysqli_close($mysqli);
?>
