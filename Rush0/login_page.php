<?PHP
include("header.php"); 
session_start();?>
<html>
<head>
    <title> Shop Online </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <form method="post" action="login.php" class="form">
        <h1 style="text-align: center;">Shop online</h1>
        <p>Login :</p>
        <input type="text" name="login" placeholder="Login" class="input" required>
        <br>
        <br>
        <p>Password :</p>
        <input type="password" name="passwd" placeholder="Password" class="input"  required>
        <br>
        <br>
        <input class="button" type="submit" name="submit" value="Login">
    </form>
</body>
</html>
