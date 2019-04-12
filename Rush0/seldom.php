<?php
$connection = mysql_connect('localhost', 'root', ''); //The Blank string is the password
mysql_select_db('DB');

$query = "SELECT login, passwd FROM Users"; //You don't need a ; like you do in SQL
$result = mysql_query($query);

echo "<table>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
	echo "<tr><td>" . $row['login'] . "</td><td>" . $row['passwd'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysql_close(); //Make sure to close out the database connection
?>
