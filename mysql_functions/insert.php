<?php

  // Send the email.
  $body = "Your password to log in to Forevent has been changed to: $p 
  Please log in using this password and your email address. At that time 
  you may change your password to something more familiar.";

  $page = "http://www.forevent.com/signin/connection_trouble/confirmt.php?" . "x=121";

  // Create the activation code.
  $a = md5(uniqid(rand(), true));

  $query2 = "INSERT INTO email_handler (body, redirect_page, sending_email, topic, active, added_datetime)
  VALUES ('$body', '$page', '$e', 'forgotpassword','$a', NOW())";
  $result2 = mysql_query ($query2) or trigger_error("Query: $query2\n<br>MySQL Error: " . mysql_error()); 
  $ehandlerid = @mysql_insert_id();

  // Finish the page.
  $page = "http://www.intimemo.com/email_handling/index.php?ehandler_id=$ehandlerid&user_id=$uid";
  header("Location:" . $page);
  mysql_close();
  exit();

?>
