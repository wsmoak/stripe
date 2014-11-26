<?php require_once('./config.php'); ?>

<form action="charge-simple-checkout-with-amount.php" method="post">
  Amount: <input type="text" name="amount" />
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Donation">
  </script>
</form>