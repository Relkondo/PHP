<?php
include('header.php'); /*
Users : login passwd permission
Carts : login hache1 hache2 hache3
Products : price name stock mate */
?>
<html class="prettybody">
    <head>
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body >
        <div>
         <header class="hear">
         <a class="active" href="index.php" title="Home" >Hache en bois</a>
         <a href="index.php" title="Login" >Toute les Haches</a>
         </header>
        </div>
        <div class="row">
         <div class="col-25">
            <div class="container">
<?PHP



$mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");
$query = "SELECT name, price, stock FROM Products";
$product = $mysqli->query($query);

if (!$_SESSION['prod'])
{
    while ($item = mysqli_fetch_assoc($product))
    {
       $tmp = $item['name'];
       $prod[$tmp] = 0;
   }
   $_SESSION['prod'] = $prod;
}
$k = 0;
$i = 0;
$product = $mysqli->query($query);
while ($item = mysqli_fetch_assoc($product))
{
 
    $tmp = $item['name'];
    $k += $_SESSION['prod'][$tmp];
    $i += $_SESSION['prod'][$tmp] * $item['price'];
    echo "<form method=\"post\" action=\"incremental.php\" ><p>".$item['name']." quantit&eacute; ".$_SESSION['prod'][$tmp]." ";
    echo "<button type=\"submit\" name=\"add\" value=\"".$item['name']."\">add</button>";
    echo "<button type=\"submit\" name=\"min\" value=\"".$item['name']."\">min</button>\tPrix\t".$item['price']."</p></form> ";
}
$_SESSION['total'] = $i;
$_SESSION['nu_of_p'] = $k;
mysqli_close($mysqli);
?>
        </div>
    </body>
</html>