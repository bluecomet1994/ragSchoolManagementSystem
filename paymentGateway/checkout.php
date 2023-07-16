<?php
//check out page for the student portal payment using stripe
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integartion (Stripe)</title>
 

</head>

<body>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-container">
                <form autocomplete="off" action="checkout-charge.php" method="POST">



                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51J7i2wKy85cwwCHPPvi6Zc0GGkisZlVRIxi6ln8rVs66cBEGaJcYfKEp1rY5auwhBVAYcvqHvRE49deQqtXXumb000Wg1MVKOK">
                    </script>

                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkout-container">
                <h4>Your Portal Access service fee</h4>

                <span>Price &nbsp;:&nbsp;<?php echo "5000" ?></span>
            </div>
        </div>
    </div>

    <?php

    ?>

</body>

</html>