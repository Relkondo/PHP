#!/usr/bin/php
<?php
if ($argc < 2)
    echo "\n";
else
{
    $tab = trim(preg_replace('/\s+/', " ", $argv[1]));
    $result = explode(" ", $tab);
    $first = array_shift($result);
    foreach ($result as $elem)
        echo $elem." ";
    echo $first."\n";
}
?>
