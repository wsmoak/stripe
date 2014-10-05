#! /usr/bin/ruby

# Example of deleting a plan on a connected user's account

require "stripe"

# You can do it by passing the access token as an additional parameter on calls made with your own secret key

Stripe.api_key = ENV['STRIPE_SECRET_KEY']

access_token = ENV['STRIPE_ACCESS_TOKEN']

p Stripe.api_key

plan_id = "gold" + rand(1..10).to_s

Stripe::Plan.create(
 {  :amount => 2000,
  :interval => 'month',
  :name => 'Amazing Plan '+ plan_id,
  :currency => 'usd',
  :id => plan_id},
  access_token
)

plan = Stripe::Plan.retrieve(plan_id,access_token)

p plan

puts "Sleeping..."
sleep(30)

plan.delete

# Or you can do it by using the access token directly as the api key

Stripe.api_key = access_token
plan_id = "gold" + rand(1..10).to_s

Stripe::Plan.create(
  :amount => 2000,
  :interval => 'month',
  :name => 'Amazing Plan '+ plan_id,
  :currency => 'usd',
  :id => plan_id
)

plan = Stripe::Plan.retrieve( plan_id )

p plan

puts "Sleeping..."
sleep(30)

plan.delete
