# For comparing email body to avoid repetition use md5:

// ------------------------------------------------------------------------------------------------
// Verify the body for no repetition at similar Date
$new_msg_body_md5 = md5(fixEncoding($body)) ;
$similar_email_check = false;

// Select the emails that have already been stored at the same time as this one and compare bodies
$sql_str = "SELECT SYS_EMAIL_QUEUE.*, SYS_EMAIL_QUEUE.UID AS EMAILQ_ID 
            FROM SYS_EMAIL_QUEUE 
            WHERE SYS_EMAIL_QUEUE.DATE_TIME_ADDED = '" . $message_date . "'"
            . " AND LNK_USER = " . $user_id
            . " AND LNK_CONNECTED_EMAIL = " . $econnected_id ;
$qry = new dbQuery($sql_str,"File: " . __FILE__ . " LINE " . __LINE__) ;
$emailq_recs = $qry -> getRecords() ;
$emailq_rec_count = $qry -> getCount() ;
unset($qry) ;

if ($emailq_rec_count > 0)
{    
  foreach($emailq_recs as $emailq_rec)
  {
    // Check if the Email body, subject and from_name are the same
    if ($email_subject = $emailq_rec['EMAIL_SUBJECT'] 
          && $new_msg_body_md5 == md5($emailq_rec['EMAIL_BODY']))
    {
      // Similar email condition
      $similar_email_check = true ;
    }
  }
}
