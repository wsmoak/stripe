#! /usr/bin/ruby

# from Stripe api-discuss 2014-11-26
# check whether an invoice item exists before creating it

require "stripe"
Stripe.api_key = ENV['STRIPE_SECRET_KEY']

def make_customer

  # simulate token from Stripe.js or Checkout
  token = Stripe::Token.create(
    :card => {
      :number => "4242424242424242",
      :exp_month => 11,
      :exp_year => 2015,
      :cvc => "314"
      })

  # create customer
  $cust = Stripe::Customer.create(
    :description => "Customer for check-invoice-item.rb",
    :card => token.id
  )
  
end

def make_invoice_item

  Stripe::InvoiceItem.create(
      :customer => $cust.id,
      :amount => 1000,
      :currency => "usd",
      :description => "One-time setup fee"
      )
end

def check_and_make_invoice_item

  # retrieve invoice items
  items = Stripe::InvoiceItem.all( customer: $cust.id )

  # check the array of items in the 'data' property  
  make_invoice_item if items.data.empty? 

  # retrieve the invoice items again
  items = Stripe::InvoiceItem.all( customer: $cust.id )
  
  # this should always be 1
  puts "The customer has #{items.data.count} invoice item"
    
end

make_customer

check_and_make_invoice_item

check_and_make_invoice_item