<?php

if ($artid) {

	$query = "SELECT picname, internal_url FROM ang WHERE ang_id='$artid'";
	$result = mysql_query($query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysql_error());
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$picname = $row[0];
	$gparenturl = $row[1];
	$pic_block = "<img src=\"/$gparenturl/rb$picname\" alt=\"$name\">";
} else {

?>
