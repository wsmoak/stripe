<?php
  require_once('./config.php');
    
    $token  = $_POST['stripeToken'];
    $email  = $_POST['emailAddress'];

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
    
    echo "This could be some JSON...";

?>