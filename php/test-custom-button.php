<?php require_once('./config.php'); ?>

<script src="https://checkout.stripe.com/checkout.js"></script>

<button id="customButton">Purchase</button>

<script>
  var handler = StripeCheckout.configure({
    key: 'pk_test_4ZzD3dUkMiTnVLpwymISz9Uf',
    image: '/square-image.png',
    token: function(token) {
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
      console.log(token)
      var xhReq = new XMLHttpRequest();
      var url = "charge-custom-button.php?stripeToken"+token.id;
      xhReq.open("GET", url, false);
      xhReq.send(null);
      var serverResponse = xhReq.responseText;
      alert(serverResponse);
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