<?php

// Add the user.
$query = "INSERT INTO users (email, password, username, regdate, active)
VALUES ('$e', SHA('$p'), '$un', NOW(),'$a')";
$result = mysql_query ($query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysql_error()); 

if (mysql_affected_rows() == 1) { // If it ran OK.
  
  // If an art is selected, enter it in the reg_ang table...
  $userid = @mysql_insert_id();
  
}

?>
