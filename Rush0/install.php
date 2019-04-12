<?php


$mysqli = new mysqli("e2r12p6:3306", "samy", "tititi");
if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."\n";
}
echo $mysqli->host_info . "\n";

$sql_create_DB = "CREATE DATABASE DB";
if ($mysqli->query($sql_create_DB) === TRUE) {
	        echo "Database created successfully\n";
} else {
	        echo "Error creating database: " . $mysqli->error."\n";
}

$sql_use_DB = "USE DB";
if ($mysqli->query($sql_use_DB) === TRUE) {
	        echo "Now using DB\n";
} else {
	        echo "Error trying to use DB: " . $mysqli->error."\n";
}

$sql_delete_tbl = "DROP TABLE Users";
if ($mysqli->query($sql_delete_tbl) === TRUE) {
	        echo "Table Users deleted\n";
} else {
	        echo "Error trying to delete table Users: " . $mysqli->error."\n";
}

$pjo = hash ('whirlpool', mysqli_real_escape_string($mysqli, 'pjo'));
$pwill = hash ('whirlpool', mysqli_real_escape_string($mysqli, 'pwilliam'));
$pjack = hash ('whirlpool', mysqli_real_escape_string($mysqli, 'pjack'));
$paver = hash ('whirlpool', mysqli_real_escape_string($mysqli, 'paverell'));

$sql_create_tbl = "CREATE TABLE Users (\nid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,\nlogin VARCHAR(30) NOT NULL,\npasswd VARCHAR(300) NOT NULL,\npermission VARCHAR(30) NOT NULL)";
if ($mysqli->query($sql_create_tbl) === TRUE) {
	echo "Users Table successfully created\n";
	$sql_add = "INSERT INTO Users (login, passwd, permission) VALUES ('Jo', '".$pjo."', 'admin')";
	if ($mysqli->query($sql_add) === TRUE) {
		echo "User Jo created\n"; }
	else { 
		echo "Error trying to create User Jo: " . $mysqli->error."\n";
	}
	$sql_add = "INSERT INTO Users (login, passwd, permission) VALUES ('William', '".$pwill."', 'pigeon')";
	$mysqli->query($sql_add);
	$sql_add = "INSERT INTO Users (login, passwd, permission) VALUES ('Jack', '".$pjack."', 'pigeon')";
	$mysqli->query($sql_add);
	$sql_add = "INSERT INTO Users (login, passwd, permission) VALUES ('Averell', '".$paver."', 'admin')";
	$mysqli->query($sql_add);
} else {
	        echo "Error creating Users table: " . $mysqli->error."\n";
}


$sql_delete_tbl = "DROP TABLE Carts";
if ($mysqli->query($sql_delete_tbl) === TRUE) {
	        echo "Table Carts deleted\n";
} else {
	        echo "Error trying to delete table Carts: " . $mysqli->error."\n";
}

$sql_create_tbl = "CREATE TABLE Carts (\nid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,\nlogin VARCHAR(30) NOT NULL,\nhache1 INT(6),\nhache2 INT(6),\nhache3 INT(6))";
if ($mysqli->query($sql_create_tbl) === TRUE) {
	echo "Carts Table successfully created\n";
	$sql_add = "INSERT INTO Carts (login, hache1, hache2, hache3) VALUES ('Jo', 0, 0, 0)";
	if ($mysqli->query($sql_add) === TRUE) {
		echo "cart of Jo created\n"; }
	else { 
		echo "Error trying to create cart of Jo: " . $mysqli->error."\n";
	}
} else {
	        echo "Error creating Carts table: " . $mysqli->error."\n";
}

$sql_delete_tbl = "DROP TABLE Products";
if ($mysqli->query($sql_delete_tbl) === TRUE) {
	        echo "Table products deleted\n";
} else {
	        echo "Error trying to delete table Products: " . $mysqli->error."\n";
}

$sql_create_tbl = "CREATE TABLE Products (\nid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,\nname VARCHAR(30) NOT NULL,\nprice INT(6),\nstock INT(6),\nmate VARCHAR(30))";
if ($mysqli->query($sql_create_tbl) === TRUE) {
	echo "Product Table successfully created\n";
	$sql_add = "INSERT INTO Products (name, price, stock, mate) VALUES ('hache1', 100, 0, 'bois')";
	if ($mysqli->query($sql_add) === TRUE) {
		echo "product hache1 created\n"; }
	else { 
		echo "Error trying to create product hache1: " . $mysqli->error."\n";
	}
	$sql_add = "INSERT INTO Products (name, price, stock, mate) VALUES ('hache2', 200, 10, 'bois')";
	$mysqli->query($sql_add);
	$sql_add = "INSERT INTO Products (name, price, stock, mate) VALUES ('hache3', 300, 50, 'metal')";
	$mysqli->query($sql_add);
} else {
	        echo "Error creating Products table: " . $mysqli->error."\n";
}

$_SESSION["user"] = "";
$_SESSION["permission"] = "pigeon";
$_SESSION["cart"] = "";


$mysqli->close();

/*
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>install</title>
</head>
<body>
    <h2>Page Temporaire.</h2>
    <p>Init database</p>
    <form action="install.php" method="post">
        <input type="submit" name="submit" value="Valider"><br><br>
    </form>
</body>
</html>
 */
?>
