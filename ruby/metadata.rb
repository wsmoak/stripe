# How to work with metadata in Ruby

require "stripe"
Stripe.api_key = ENV['STRIPE_SECRET_KEY']

customer = Stripe::Customer.create(
  :email => "someone@example.com" 
)

# set the metadata
customer.metadata = {"foo" => "bar"}

customer.save

customer = Stripe::Customer.retrieve( customer.id )

puts customer

# completely overwrite the metadata
customer.metadata = {"abc" => 123}

customer.save

customer = Stripe::Customer.retrieve( customer.id )

puts customer

# add to the metadata
customer.metadata["zzz"] = "test"

# change the value of an existing key
customer.metadata["abc"] = 987

customer.save

customer = Stripe::Customer.retrieve( customer.id )

puts customer
