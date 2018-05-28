<?php

	if ($bd1 && $bd2 && $bd3 && $chg) { // If everything's OK.
		
		// Make the query.
		$query = "UPDATE members SET birthdate1='$bd1', birthdate2='$bd2', birthdate3='$bd3' WHERE member_id={$_SESSION['member_id']}";
		$result = mysql_query($query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysql_error());
			
		if (mysql_affected_rows() == 1) { // If it ran OK.
			
			$page = "http://www.ioneec.com/settings/personal_info/index.php?" . "x=12377";
			header("Location:" . $page);
			mysql_close(); // Close the database connection.
			exit();
				
		} else { // if it did not run OK.
			
			// Send a message to the error log, if desired.
			$display_block .= '<p><font color="red">Your birthdate could not be changed due to a system error. We apologize for any inconvenience.</font></p>';
				
		}
			
	} else { // Failed the validation test.
		$display_block .= '<p><font color="red">Please try again</font></p>';
	}

?>
