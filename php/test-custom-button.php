<?php require_once('./config.php'); ?>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript" src="jquery-1.11.1.js"></script>


<button id="customButton">Purchase</button>

<script>
  var handler = StripeCheckout.configure({
    key: 'pk_test_4ZzD3dUkMiTnVLpwymISz9Uf',
    image: '/square-image.png',
    token: function(token) {
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
      console.log(token);
      
      $.ajax({
        type: "POST",
        url: "charge-custom-button.php",
        data: { stripeToken: token.id, stripeEmail: token.email }
      })
      .done(function( msg ) {
          alert( "Server response: " + msg );
      });  
      
    }
  });
  

  document.getElementById('customButton').addEventListener('click', function(e) {
    // Open Checkout with further options
    handler.open({
      name: 'Demo Site',
      description: '2 widgets ($20.00)',
      amount: 2000
    });
    e.preventDefault();
  });
</script>