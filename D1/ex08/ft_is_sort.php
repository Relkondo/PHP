#!/usr/bin/php
<?php
function ft_is_sort($arr){
	$sorted = $arr;
	sort($sorted);
	if (array_diff_assoc($sorted, $arr) == null)
		return true;
	return false;
}
