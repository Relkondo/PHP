<?PHP session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chop online</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<div class="header">
  <a href="index.php" class="logo">Chop online</a>
  <div class="header-right">
    <a class="active" href="index.php" title="Home" >Home</a>

<?PHP
if (isset($_SESSION['nu_of_p']))
{
  echo     "<a href=\"cart_page.php\" title=\"Checkout\">"."Cart: ".$_SESSION['nu_of_p']."</a>";
}
else {
    echo "<a href=\"cart_page.php\" title=\"Checkout\">Cart</a>";
}
if (!isset($_SESSION['user']))
{
    echo "<a href=\"login_page.php\" title=\"Login\" >Login</a>";
    echo  "<a href=\"register_page.php\" title=\"Register\" >Register</a>";
}
if ($_SESSION['permission'] == "admin")
  echo "<a href=\"admin_page.php\" title=\"admin\">Admin</a>";
?>
  </div>
</div>
</body>
</html>