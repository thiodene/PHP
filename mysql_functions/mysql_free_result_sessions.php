<?php
if ($e && $p) { // If everything's OK.

  // Query the database.
  $query = "SELECT user_id, username, email, inboxview_date FROM users WHERE (email='$e' AND password=SHA('$p')) AND active IS NULL";
  $result = mysql_query($query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysql_error());

  if (@mysql_num_rows($result) == 1) { // A match was made.

    $row = mysql_fetch_array($result, MYSQL_NUM);

    // Register the values & redirect.
    mysql_free_result($result);
    mysql_close(); // Close the database connection.
    $_SESSION['email'] = $row[2];
    $_SESSION['username'] = $row[1];
    $_SESSION['user_id'] = $row[0];
    $_SESSION['last_vinbox'] = $row[3];

    // Start defining the URL.
    $url = 'http://' . $_SERVER['HTTP_HOST'];
    // Check for a trailing slash.
    if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
      $url = substr ($url, 0, -1);
      // Chop off the slash.
    }
    // Add the page.
    $url .= '/myforevent/index.php';

    ob_end_clean(); // Delete the buffer.
    header("Location: $url");;
    exit(); // Quit the script.

  } else { // No match was made.
    $display_block .= '<p><font color="red">Either the email address and password entered do not match<br> those on file or
    you have not yet activated your account.</font></p>';
    $display_block .= '<p><font color="red">Please try again.</font></p>';
  }

} else { // If everything wasn't OK.
  $display_block .= '<p><font color="red">Please try again.</font></p>';
}
  
?>
