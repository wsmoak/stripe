<?php
  require_once('./config.php');
  
  var_dump($_POST);
  
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $amount = $_POST['amount'];
  $recurring = $_POST['recurring'];

  $customer = Stripe_Customer::create(array(
      'email' => $email,
      'card'  => $token
  ));
  
  if ( !empty($recurring) ) {

    //is there already a plan?
    
    //make a plan if not
    
    //subscribe the customer to it    

    echo "<h1>Successful subscription for {$amount}/month!</h1>";    
    
  } else {

  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount * 100,
      'currency' => 'usd',
      'description' => 'donation, amount supplied by customer'
  ));

  echo "<h1>Successfully charged {$amount}!zz</h1>";
  
  }


?>