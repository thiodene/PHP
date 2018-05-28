<?php


if ($uid) { // If everything's OK.

  // Create a new random password.
  $p = substr( md5(uniqid(rand(),1)), 3, 10);

  // Make the query.
  if ($act == NULL) {

    $query = "UPDATE users SET password=SHA('$p') WHERE user_id=$uid";
    $result = mysql_query($query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysql_error());

    if (mysql_affected_rows() == 1) { // If it ran OK.
