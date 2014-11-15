<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $coupon_id  = $_POST['coupon_id'];
  
  $customer = Stripe_Customer::create(array(
      'email' => $email,
      'card'  => $token,
	  'plan'  => 'monthly',
      'coupon' => $coupon_id
  ));

  echo "<h1>Successful Subscription!</h1>";

?>