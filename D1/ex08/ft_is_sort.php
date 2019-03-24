#!/usr/bin/php
<?php

function	ft_is_sort($tab)
{
	$res = $tab;
	sort($res);
	if ($tab == $res)
		return (TRUE);
	else
		return (FALSE);
}
?>
