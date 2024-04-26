<?php

include './stripe-php-master/init.php';
//require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('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');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://myxogos.com/admin';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1OpZ71IryzBLFRCst69baNTV',
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
