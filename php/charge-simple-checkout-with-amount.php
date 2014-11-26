<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $amount = $_POST['amount'];

  $customer = Stripe_Customer::create(array(
      'email' => $email,
      'card'  => $token
  ));

  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount * 100,
      'currency' => 'usd',
      'description' => 'donation, amount supplied by customer'
  ));

  echo "<h1>Successfully charged {$amount}!</h1>";

?>