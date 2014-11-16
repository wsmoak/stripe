<?php require_once('./config.php'); ?>
<html>
<head>
  <script type="text/javascript" src="jquery-1.11.1.js"></script>
</head>
<body>
<h1>Monthly Subscription - $29.95</h1>
<form action="charge-validate-coupon.php" method="post">

  Coupon Code: <input type=text size="6" id="coupon" name="coupon_id" />
  <span id="msg"></span>
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="2995"
    data-description="Monthly Subscription"
    data-label="Subscribe"
    data-allow-remember-me="false">
	</script>
</form>

<script>
$(document).ready(function(){
  $('#coupon').change(function(){
    requestData = "coupon_id="+$('#coupon').val();
    $.ajax({
      type: "GET",
      url: "validate-coupon.php",
      data: requestData,
      success: function(response){
        if (response) {
          $('#msg').html("Valid Code!")
        } else {
          $('#msg').html("Invalid Code!");
        }
      }
    });
  });
});
</script>

</body>
</html>
