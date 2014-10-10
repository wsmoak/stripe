<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  
  var_dump($_POST); 

  $customer = Stripe_Customer::create(array(
      'email' => $email,
      'card'  => $token
  ));


#testing multiples in receipt email

  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 2000,
      'currency' => 'usd',
      'description' => 'Widget, Qty 2'
  ));

  echo '<h1>Successfully charged $20.00!</h1>';

?>