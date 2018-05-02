<?php

function processOnlineCateringPayment($payment_info)
{
  $pay_info = json_decode($payment_info) ; 
  
  // First process payment
  $cc_info = array('cc_num' => $pay_info -> cc_num
                  ,'expiry_month' => $pay_info -> expiry_month
                  ,'expiry_year' => $pay_info -> expiry_year
                  ,'cvd' => $pay_info -> cvd
                  ,'name_on_cc' => $pay_info -> name_on_cc) ;
       
  // Process the payment online. If it goes through, then set the deposit as paid
  // otherwise leave the deposit as due or past due so user can try the payment again
  $pay_result = processOnlinePaymentBambora($pay_info -> order_num,'Online Catering'
                                      ,$pay_info -> order_total
                                      ,PAYMENT_TRANSACTION_TYPE_PURCHASE,$cc_info) ;                 
  if ($pay_result['error']) 
    $result = "paymentProcessingEnded() ;" 
            . " xmlbAlert('" . $pay_result['error_desc'] . "<br /><br />Please try again.') ; " ; 
  else // All good, so process
  {
    $payment_info = array() ;
    $payment_info['payment_amount'] = $pay_info -> order_total ;
    $payment_info['overhead_percent'] = 0 ;
    $payment_info['payable_amount'] = $pay_info -> order_total ;
    $payment_info['trans_record'] = $pay_result['trans_record'] ;
    $payment_info['notes'] = 'Online process for catering.' ; 
    $payment_info['was_fine'] = YES ;
    $result = buildCateringEventFromTemp($pay_info -> catering_cust_id
                                                ,$pay_info -> cc_type,$payment_info) ; 
  }
  
  return $result ;
} // processOnlineCateringPayment

?>
