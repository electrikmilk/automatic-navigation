<?php

if (!file_exists("content")) {
	exit;
}
if (!is_dir("content")) {
	exit;
}

function title_case(string $str): string
{
	$no_cap = ["and", "as", "but", "for", "if", "nor", "or", "so", "yet", "a", "an", "the", "as", "at", "by", "for", "in", "of", "off", "on", "per", "to", "up", "via"];
	$words = explode(" ", $str);
	$output = [];
	$i = 0;
	foreach ($words as $word) {
		if (!in_array(trim($word, ","), $no_cap) || $i === 0) {
			$word = ucwords($word);
		}
		$output[] = $word;
		++$i;
	}
	return implode(" ", $output);
}

function list_items($path)
{
	$items = scandir($path);
	if (count($items)) {
		echo "<ul>";
		foreach ($items as $item) {
			$label = pathinfo($item, PATHINFO_FILENAME);
			$url = str_replace(" ", "-", str_replace("content", "", $path) . "/$label");
			if ($item === "." || $item === "..") {
				continue;
			}
			if (is_dir("$path/$item")) {
				echo "<li>$label";
				list_items("$path/$item");
				echo "</li>";
			} else {
				echo "<li><a href='$url'>" . title_case($label) . "</a></li>";
			}
		}
		echo "</ul>";
	}
}

list_items("content");