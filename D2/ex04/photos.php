#!/usr/bin/php
<?php

if ($argc < 1)
	exit();

$cu = curl_init($argv[1]);
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($cu);
curl_close($cu);

if ($html === false)
	exit("Could not get page\n");

$url_array = parse_url($argv[1]);
$folder = $url_array['host'];
if (file_exists($folder) === false || is_dir($folder) === false)
	mkdir($folder);
chdir($folder);

preg_match_all('/<img[^>]+src="([^\s>]+)"/i', $html, $pics, PREG_PATTERN_ORDER);
if (isset($pics[1])) {
	foreach ($pics[1] as $ele) {
		if ($ele[0] === '/')
			$ele = $url_array['scheme'] . '://' . $url_array['host'] . $ele;
		$cu = curl_init($ele);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
		$contents = curl_exec($cu);
		curl_close($cu);
		$file = basename($ele);
		file_put_contents($file, $contents);
	}
}
