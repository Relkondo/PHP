#!/usr/bin/php
<?php

function ft_split($str)
{
    $tab = explode(" ", $str);
    $result = array();
    foreach ($tab as $elem)
    {
        if ($elem != "")
            array_push($result, $elem);
    }
    sort($result);
    return ($result);
}

$res = array();
foreach($argv as $arg)
{
    if ($arg != $argv[0])
    {
        $tab = ft_split($arg);
        $res = array_merge($res, $tab);
    }
}
sort($res);
foreach ($res as $elem)
    echo $elem."\n";
?>
