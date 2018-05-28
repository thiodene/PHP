<?php

// Constructing notable artists block

$query21 = "SELECT artist_id, name, internal_url, nvisits FROM artists, ang_related WHERE ang_id='$ang_id' AND actortype_id='1' AND ang_related.actor_id=artists.artist_id ORDER BY nvisits DESC LIMIT 20";
$result21 = mysql_query($query21) or trigger_error("Query: $query21\n<br>MySQL Error: " . mysql_error());

if (mysql_num_rows($result21) != 0) {
	$notable_block = "<p class=\"uinfo\"><em class=\"uinfotopic\">Notable Artists:</em> ";
	$nnot = 1;
	while ($row21 = mysql_fetch_array($result21, MYSQL_ASSOC)) {
		if ($nnot == 1) { 	
			$notable_block .= "<a href=\"http://www.forevent.com/" . $row21['internal_url'] . "\" target=\"_self\">" .  ucwords($row21['name']) . "</a>";
		} else {
			$notable_block .= ", " . "<a href=\"http://www.forevent.com/" . $row21['internal_url'] . "\" target=\"_self\">" .  ucwords($row21['name']) . "</a>";
		}
		$nnot++;
	} $notable_block .= "</p>";
} else {
	$notable_block = FALSE;
}

?>
