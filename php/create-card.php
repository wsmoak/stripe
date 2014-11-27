<?php
  require_once('./config.php');

#from the api docs https://stripe.com/docs/api#create_card

# You probably do not want to do this !!
# In general you should tokenize the card on the client side and send ONLY the token to your server.

$customer = Stripe_Customer::retrieve("cus_4ptAociLX3377l");

$card = $customer->cards->create(
  array( 
    "card" => 
      array( 
        "number"=> "4242424242424242", 
        "exp_month" => "12", 
        "exp_year" => "2016", 
        "cvc" => "123" 
      )
   )
);

echo $card

?>