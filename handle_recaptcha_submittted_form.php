<?php

//First check g-recaptcha-response 
$captcha = '' ;
if(isset($_POST['g-recaptcha-response']))
  $captcha = $_POST['g-recaptcha-response'];

$ip = $_SERVER['REMOTE_ADDR'];

// If no ReCAPTCHA click by customer               
if(empty($captcha))
{
  setGlobalMsg("Please verify that you are not a robot!") ;
  return false ;
}

// SecretKey given by google recapcha
$secretKey = "6LeQ7UoUAAAAAIS786F6Sl-sQAP5n1L20GMMmMuy";  

// use curl to POST secretkey,response and ip to google URL         
$opts = array(
            'remoteip' => $ip,
            'response' => $captcha,
            'secret' => $secretKey
            );

$url = "https://www.google.com/recaptcha/api/siteverify";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, 1); // Means the curl method is POST
curl_setopt($curl, CURLOPT_POSTFIELDS,$opts);

// receive server response in json format...
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($curl);
$server_output_json = json_decode($server_output,true);
curl_close ($curl);  

// If success=1 means user is not robot 

if($server_output_json['success'] == 1)
{
  // Staff member to send this message to (used this way for Debug)
  //$staff_email = 'serge@azarbod.com' ;
  $staff_email = 'info@mapletools.ca' ;

  // ReCaptcha is good, so send the message to Maple Tools
  $email_params = array() ;
  $email_params['to_email'] = $staff_email ;
  $email_params['from_name'] = $_POST['new_customer_first_name'] ;
  $email_params['from_email'] = $_POST['new_customer_main_email'] ;
  $template_params = array() ;
  $full_name = $_POST['new_customer_first_name'] ;
  if(isset($_POST['new_customer_position']) && trim($_POST['new_customer_position']) != '')
    $full_name .= ', ' . $_POST['new_customer_position'] ;
  if(isset($_POST['new_customer_customer_name']) && trim($_POST['new_customer_customer_name']) != '')
    $full_name .= ' from ' . $_POST['new_customer_customer_name'] ;
  $template_params['name'] = $full_name ;
  $template_params['phone'] = $_POST['new_customer_main_phone'] ;
  $template_params['email'] = $_POST['new_customer_main_email'] ;
  $inquiry = htmlspecialchars($_POST['new_customer_contact_notes']) ;
  $inquiry = trim(str_replace("\n","<br />",$inquiry)) ;
  $inquiry = removeExtraSpaces($inquiry) ;
  $inquiry = fixEncoding($inquiry) ;
  $template_params['inquiry'] = $inquiry ;
  $mail = new JBurstMailer($email_params) ;
  $mail -> template_id = 'Contact Form' ;
  $mail -> template_params = $template_params ;
  $mail -> how_generated = EMAIL_HOW_GEN_CONTACT_PAGE ;
  $mail -> priority = EQ_PRIORITY_URGENT ;
  $mail -> Send() ;
  setGlobalMsg("The Message was successfully sent to Maple Tools Supply Ltd.") ;
} 
else 
  return false ;
  
?>
