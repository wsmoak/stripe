<?php
  require_once('./config.php');
  
  var_dump($_POST);
  
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $amount = $_POST['amount'];
  $recurring = $_POST['recurring'];

  // validate the amount

  $plan_id = "monthly{$amount}";
  $plan_name = "Monthly {$amount}";
  
  if ( !empty($recurring) ) {

    try {

      $plan = Stripe_Plan::retrieve("monthly{$amount}");
    
    } catch (Stripe_InvalidRequestError $error) {

      $plan = Stripe_Plan::create(array(
        "amount" => $amount * 100,
        "interval" => "month",
        "name" => $plan_name,
        "currency" => "usd",
        "id" => $plan_id)
      );
    }
    
      $customer = Stripe_Customer::create(array(
        'email' => $email,
        'card'  => $token,
        'plan' => $plan_id
      ));

    echo "<h1>Successful subscription for {$amount}/month!</h1>";    
    
  } else {

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
  
  }


?>