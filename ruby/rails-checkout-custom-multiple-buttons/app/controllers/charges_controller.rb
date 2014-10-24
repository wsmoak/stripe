class ChargesController < ApplicationController

  def new
  end

  def create

    if params[:plan].to_sym == "monthly".to_sym then

      # create a customer and subscribe them to the monthly plan

      customer = Stripe::Customer.create(
        :email => params[:stripeEmail],
        :card  => params[:stripeToken],
        :plan  => "monthly"
      )

    elsif params[:plan].to_sym == "lifetime".to_sym then

      # create a customer and do a one-time charge
      # subscribe them to a (free) lifetime plan for recordkeeping

      customer = Stripe::Customer.create(
        :email => params[:stripeEmail],
        :card  => params[:stripeToken],
        :plan => "lifetime"
      )

      charge = Stripe::Charge.create(
        :customer    => customer.id,
        :amount      => @amount,
        :description => 'Lifetime',
        :currency    => 'usd',
        :amount      => 50000
      )

    end

    render text: "{abc: 123}"  # send some json back to the ajax call

    rescue Stripe::CardError => e
      render text: e.message

  end
  
end
