<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('your_stripe_secret_key');

$input = json_decode(file_get_contents("php://input"), true);
$amount = $input['amount'];

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Service Payment',
                ],
                'unit_amount' => $amount * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://yourdomain.com/success.php',
        'cancel_url' => 'http://yourdomain.com/index.html',
    ]);

    echo json_encode(['id' => $session->id, 'url' => $session->url]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
