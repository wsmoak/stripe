# application_fee_percent is now a decimal amount
# #stripe and api-discuss on 2014-11-29

require "stripe"

Stripe.api_version = "2014-07-22" # arbitrary old version to see if the change is gated

Stripe.api_key = ENV['STRIPE_SECRET_KEY']

access_token = ENV['STRIPE_ACCESS_TOKEN']

customer_id = ENV['STRIPE_CUSTOMER_ID']

customer = Stripe::Customer.retrieve( customer_id, access_token )

p customer

subs = customer.subscriptions.create( {:plan => "gold", :application_fee_percent => 0.05 }, access_token)

p subs

# Result: 
# decimal amounts between 0 and 100 are allowed
# the fee may be 0 if it is too small, eg. 0.01% of $20
# passing 0 or 0.00 is allowed