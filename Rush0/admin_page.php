<?PHP 
session_start();
if ($_SESSION['permission'] != "admin")
{
  header("Location: index.php");
  exit ;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chop online</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<div class="header">
  <a href="index.php" class="logo">Backwood Hunt</a>
  <div class="header-right">
    <a class="active" href="index.php" title="Home" >Home</a>
    <a href="login_page.php" title="Login" >Login</a>
    <a href="register_page.php" title="Register" >Register</a>
    <a href="cart_page.php" title="Checkout">Cart</a>
<?PHP
if ($_SESSION['permission'] == "admin")
  echo "<a href=\"admin_page.php\" title=\"admin\">Admin</a>";
?>
  </div>
</div>
<html>
<head>
    <link rel="stylesheet" href="css/admin.css" />
</head>
<body>
<div class="row">
  <div class="col-25">
    <div class="container">
      <h4>User
      </h4>
      <form method="post" action="admin.php">
          <?PHP
    $mysqli = new mysqli("localhost:3306", "root", "tototo", "DB");
    $query = "SELECT login, permission FROM Users";
    $users = $mysqli->query($query);
    while ($usr = mysqli_fetch_assoc($users))
  {
     echo "<p>".$usr['login']."<span class=\"option\"><button  name=\"del_user\" type=\"submit\" value=\"".$usr['login']."\">del_user</button></span>";
     echo "<span class=\"option\"><button type=\"submit\" name=\"res_cart\" value=\"".$usr['login']."\">res_cart</button></span>";
     if ($usr['permission'] == "admin")
      echo "<span class=\"option\"><button type=\"submit\" name=\"grade_down\" value=\"".$usr['login']."\">grade_down</button></span>";
    if ($usr['permission'] == "pigeon")
     echo "<span class=\"option\"><button  type=\"submit\" name=\"grade_up\" value=\"".$usr['login']."\">grade_up</button></span>";
     echo "<span class=\"option\"><button type=\"submit\" name=\"acces_cart\" value=\"".$usr['login']."\">acces_cart</button></span></p>";
  }
         mysqli_close($mysqli);
            ?>
      <hr>
</form>
      <p>Nb User <span class="option" style="color:black"><b>30</b></span></p>
  </div>
  </div>
    <div class="container">
    <h3>Change password of user </h3><br>
     <form method="post" action="admin.php" >
     login_to_change<input type="text" name="login_to_change" required><br>
     pwd_to_chg<input type="text" name="pwd_to_chg" required><br>
    <input type="submit" name="submit" value="OK">
  </form>
  <form method="post" action="admin.php" >
    <div>
    name_of_product<input type="text" name="name_of_prod" required><br>
    price_of_product<input type="text" name="price_of_prod"><br>
    stock<input type="text" name="stock"><br>
    quality<input type="text" name="quality"><br>
    <input type="submit" name="new_p" value="OK">
    <input type="submit" name="del_p" value="OK">
   </div>
</form>
  </div>

</div>
</body>
</html>
