#! /usr/bin/ruby

# see http://wiki.wsmoak.net/cgi-bin/wiki.pl?StripeCouponLimit
# an example of storing metadata and checking it later

require "stripe"
Stripe.api_key = ENV['STRIPE_SECRET_KEY']

access_token = ENV['STRIPE_ACCESS_TOKEN']

customer_id = ENV['STRIPE_CUSTOMER_ID']
  
#customer = Stripe::Customer.retrieve(customer_id)

#customer.subscriptions.create( {:plan => "monthly", :application_fee_percent => 10 }, access_token)
#No such customer: cus_4nqoNa0Vt3Fm3w (Stripe::InvalidRequestError)
# I think because the customer is up on the account owner rather than down at the connected account

# try it without the application fee?
# customer.subscriptions.create( {:plan => "monthly" }, access_token)
# this also fails

# So, save the customer down at the connected account

# this is from https://stripe.com/docs/connect/shared-customers#making-a-charge 
token = Stripe::Token.create(
  {:customer => customer_id },
  access_token # user's access token from the Stripe Connect flow
)

p token

# create a new customer at the connected account level (using access_token)
newcustomer = Stripe::Customer.create({:card => token.id } , access_token)

p newcustomer

# plan needs to exist in connected account
newcustomer.subscriptions.create( {:plan => "monthly", :application_fee_percent => 10 }, access_token)

#this works.  the customer was charged $14.99, and the connected account paid a $1.50 application fee plus the 2.9% + $0.30

# https://stripe.com/docs/connect/shared-customers only talks about 'charges' not 'subscriptions' 
