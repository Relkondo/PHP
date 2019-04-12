<?php
session_start();
header("Location: index.php");
if (isset($_POST['add']))
{
     $tmp = $_POST['add'];
    $_SESSION['prod'][$tmp]++;
    $_POST['add'] = "123";
}
if (isset($_POST['min']))
{
    $tmp = $_POST['min'];
    if ($_SESSION['prod'][$tmp] > 0)
        $_SESSION['prod'][$tmp]--;
    $_POST['add'] = "123";
}



?>