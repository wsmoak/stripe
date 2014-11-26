# examples of https://stripe.com/docs/api/python#list_customers

import os
import stripe

stripe.api_key = os.environ['STRIPE_SECRET_KEY']

# list all customers (10 by default) 
print stripe.Customer.all()

# list customers created on 2014-10-01
print stripe.Customer.all(created=1412121600)

# list customers creatd between 2014-10-01 and 2014-10-31
print stripe.Customer.all( limit=100, created={"gte": 1412121600, "lte": 1414713600} )

# include the total count
print stripe.Customer.all( limit=25, include=["total_count"] )
