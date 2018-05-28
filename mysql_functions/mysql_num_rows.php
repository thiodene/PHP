<?php

$query14 = "SELECT name, internal_url FROM ang WHERE ang_id='$directid'";
$result14 = mysql_query($query14) or trigger_error("Query: $query14\n<br>MySQL Error: " . mysql_error());

if (mysql_num_rows($result14) != 0) {
  $row14 = mysql_fetch_array($result14, MYSQL_NUM);
  $directid = $row14[0];
  $globalid = $row14[1];
  $precgenre_block = "<p class=\"uinfo\"><em class=\"uinfotopic\">Precursive Genre:</em> ";
  $precgenre_block .= "<a href=\"http://www.forevent.com/" . $row14[1] . "\" target=\"_self\">" .  ucwords($row14[0]) . "</a>";
  $precgenre_block .= "</p>";
}

?>
