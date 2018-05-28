<?php

// Email Handler Script------------------------------------------------------
$query2 = "INSERT INTO email_handler (email_address, title, body, sender, redirect) VALUES ('$e', 'Welcome to Forevent!', '$body', 'From: Forevent.com <no_reply@forevent.com>', 'http://www.forevent.com/signup/confirm.php')";
$result2 = mysql_query ($query2) or trigger_error("Query: $query2\n<br>MySQL Error: " . mysql_error());

if (mysql_affected_rows() == 1) { // If it ran OK.
  $iid = @mysql_insert_id();

  $page = "http://www.thiodene.com/email_handler/index.php?handlerid=$iid";
  header("Location:" . $page);
  mysql_close(); // Close the database connection.
  exit();
} else {
  $display_block .= '<p><font color="red">Your message could not be sent due to a system error. We apologize for any inconvenience.</font></p>';
}

?>
