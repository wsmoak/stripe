<?php
require_once('./stripe-php-1.17.1/lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_YOUR-SECRET-KEY",
  "publishable_key" => "pk_test_YOUR-PUBLISHABLE-KEY"
);

Stripe::setApiKey($stripe['secret_key']);
?>
