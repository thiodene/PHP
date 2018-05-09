// If it is a first time for retriving Email for this user the time would be the day 
// user want to add emails from the server
if ($rec_count == 0)
  $last_email_date = date("Y-m-d" , strtotime(" -1 day"));
else
  $last_email_date = date("Y-m-d" , strtotime($emailq_rec['LATEST_DATE']. " -1 day"));
