<?php

include './stripe-php-master/init.php';
//require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51MKQt5ES8UEWC6xggaSZd8zK6yFN5RnARHjj7Q0hwOoePDlqTaR64v7GEAldkDTzbakTNznag64xni46T08I0usX00okIdhCVr');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://myxogos.com';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1OpPjOES8UEWC6xgc1y6NRJy',
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
  'success_url' => $YOUR_DOMAIN . '/stripe-one/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/stripe-one/cancel.html',
  'automatic_tax' => [
    'enabled' => true,
  ],
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
