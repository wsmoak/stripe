# see https://stripe.com/docs/checkout/guides/sinatra

require 'sinatra'
require 'stripe'

set :publishable_key, ENV['STRIPE_PUBLISHABLE_KEY']
set :secret_key, ENV['STRIPE_SECRET_KEY']

Stripe.api_key = settings.secret_key

get '/' do
  erb :index
end

post '/charge' do
  @amount = 500
  
  customer = Stripe::Customer.create(
    :email => params[:stripeEmail],
    :card  => params[:stripeToken] 
  )
    
  charge = Stripe::Charge.create(
    :amount      => @amount,
    :description => 'Sinatra Charge',
    :currency    => 'usd',
    :customer    => customer.id
  )
  
  erb :charge
end

error Stripe::CardError do
  env['sinatra.error'].message
end

__END__

@@ layout
  <!DOCTYPE html>
  <html>
  <head></head>
  <body>
    <%= yield %>
  </body>
  </html>
  
@@ index
  <form action="/charge" method="post" class="payment">
    <article>
      <label class="amount">
        <span>Amount: $5.00</span>
      </label>
    </article>

    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<%= settings.publishable_key %>"></script>
  </form>
    
@@ charge
  <h2>Thanks, you paid <strong>$5.00</strong>!</h2>
