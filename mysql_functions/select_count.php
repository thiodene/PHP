<?php

// Title with or without Past Events
$query90 = "SELECT COUNT(*) FROM events, ang_related WHERE events.mainactor_id=ang_related.actor_id AND events.actortype_id='1' AND ang_related.ang_id='$ang_id' AND spot_id IS NULL AND revent_id IS NULL";
$result90 = mysql_query($query90) or trigger_error("Query: $query90\n<br>MySQL Error: " . mysql_error());
$row90 = mysql_fetch_array($result90, MYSQL_NUM);
$num_records_past = $row90[0];
if ($num_records_past) {
  $newtitle_block = "LIVE EVENTS ($numeve)$titlepage / <a href=\"http://www.forevent.com/$url/index.php?display=nonlive\">NON-LIVE EVENTS</a>";
} else {
  $newtitle_block = "LIVE EVENTS ($numeve)$titlepage";
}

?>
