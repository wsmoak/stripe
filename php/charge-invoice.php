<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = Stripe_Customer::create(array(
      'email' => $email,
      'card'  => $token
  ));

  // Instead of just creating a charge, create some invoice items

  Stripe_InvoiceItem::create(array(
      "customer" => $customer->id,
      "amount" => 1000,
      "currency" => "usd",
      "description" => "One-time setup fee")
  );
  
  Stripe_InvoiceItem::create(array(
    "customer" => $customer->id,
    "amount" => 4000,
    "currency" => "usd",
    "description" => "Widget, qty 1")
  );

  // then create an invoice, and pay it

  $new_invoice = Stripe_Invoice::create(array(
      "customer" => $customer->id,
  ));

  $paid_invoice = $new_invoice->pay();

  echo "<h1>Successfully paid invoice for $50.00!</h1>";

?>