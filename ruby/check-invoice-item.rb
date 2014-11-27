#! /usr/bin/ruby

# from Stripe api-discuss 2014-11-26
# check whether an invoice item exists before creating it

require "stripe"
Stripe.api_key = ENV['STRIPE_SECRET_KEY']

def make_customer

  # simulate token from Stripe.js or Checkout
  # this card can be added, but all charges will be declined
  token = Stripe::Token.create(
    :card => {
      :number => "4000000000000341",
      :exp_month => 11,
      :exp_year => 2015,
      :cvc => "314"
      })

  puts "Making a customer"
  $cust = Stripe::Customer.create(
    :description => "Customer for check-invoice-item.rb",
    :card => token.id
  )
  
end

def make_invoice_item
  puts "Making an invoice item"
  Stripe::InvoiceItem.create(
      :customer => $cust.id,
      :amount => 1000,
      :currency => "usd",
      :description => "One-time setup fee"
      )
end

def make_subscription
  $cust.subscriptions.create(:plan => "monthly")
end

def retrieve_customer
  puts "Retrieving a customer"
  $cust = Stripe::Customer.retrieve( $cust.id )
end

def check_and_make_invoice_item

  # retrieve invoice items
  items = Stripe::InvoiceItem.all( customer: $cust.id )
  puts "The customer has #{items.data.count} invoice item (before)"

  # check the array of items in the 'data' property before making an invoice item
  make_invoice_item if items.data.empty? 

  # retrieve the invoice items again
  items = Stripe::InvoiceItem.all( customer: $cust.id )
  
  # this should always be 1
  puts "The customer has #{items.data.count} invoice item (after)"
    
end

make_customer

make_invoice_item # for new customer

begin
  make_subscription
rescue Stripe::CardError
  puts "The card was declined"
end

retrieve_customer

check_and_make_invoice_item # for existing customer
