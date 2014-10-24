<?php
  require_once('./config.php');
  
  echo "The POST is $_POST";
  
  var_dump($_POST);

  $state = $_POST['shippingState'];
  
  if ( !strcmp("GA", $state) ) {

    // the shipping address is in Georgia, so go ahead
    
    $token  = $_POST['stripeToken'];
    $email  = $_POST['emailAddress'];

    echo "$token and $email";

    $customer = Stripe_Customer::create(array(
        'email' => $email,
        'card'  => $token
    ));

    $charge = Stripe_Charge::create(array(
        'customer' => $customer->id,
        'amount'   => 1500,
        'currency' => 'usd',
        'description' => 'Widget, Qty 1'
    ));

    echo '<h1>Successfully charged $15.00!</h1>';

  } else {

    echo "Sorry, we can only ship to addresses in GA.";
    echo "Hit the back button and try again with 'GA' in the state field.";

  }

?>