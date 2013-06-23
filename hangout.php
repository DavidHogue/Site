<?php
$filename = "hangout.url";

$url = $_GET["url"];
if ($url) {
	$fh = fopen($filename, "w");
	fwrite($fh, $url);
	fclose($fh);
	echo "Saved $url";
} else {
	$file = fopen($filename, "r");
	$url = fread($file, filesize($filename));
	header("Location: $url");
	echo "Redirecting to $url";
}
?>
