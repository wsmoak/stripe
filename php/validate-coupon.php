<?php
  require_once('./config.php');

  $answer = false;
  $coupon_id  = $_GET['coupon_id'];
  
  // needs if coupon_id is not blank  
  try {
    $coupon = Stripe_Coupon::retrieve( $coupon_id );  
  } catch (Stripe_InvalidRequestError $e) {
	  // $answer is already set to false
  }
  
  if ($coupon->valid) {
	  $answer = true;
  }

  echo $answer;  //this sends 0 or 1
  
  //TODO:  Rework to use Stripe's status codes https://stripe.com/docs/api/php#errors
  // 200 means the coupon is valid
  // 400 means the coupon code was missing
  // 402 means it was a good coupon code, but it's expired or otherwise can't be used
  // 404 means the coupon code does not exist

?>