<?php
    //require_once "stripe-php-master/init.php";
    require_once "../stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K",
        "publishableKey" => "pk_test_51J7i2wKy85cwwCHPPvi6Zc0GGkisZlVRIxi6ln8rVs66cBEGaJcYfKEp1rY5auwhBVAYcvqHvRE49deQqtXXumb000Wg1MVKOK"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>