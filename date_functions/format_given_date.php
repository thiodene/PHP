# Use strototime to do so:

$message_date = date("Y-m-d H:i:s" ,(strtotime($header -> MailDate)));
