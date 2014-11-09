<?php require_once('./config.php'); ?>

<h1>Test with Invoice Items and Invoice</p>

<form action="charge-invoice.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-amount="5000"
          data-description="One widget">
  </script>
</form>
