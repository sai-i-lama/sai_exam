<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class CinetPayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Make the CINET Pay API request here
        // Use the $request variable to access any form data or parameters sent with the request

        $client = new Client();

        // Prepare the request payload
        $payload = [
            // Add the necessary data for the CINET Pay API request
            // For example, the amount, currency, customer details, etc.
        ];

        // Send the API request
        $response = $client->post('https://api-checkout.cinetpay.com/v2/payment', [
            'json' => $payload,
            'headers' => [
                // Add any required headers, such as API key or authentication headers
            ],
        ]);

        // Process the API response
        $responseData = json_decode($response->getBody(), true);

        // Handle the response data as needed, such as redirecting the user to the payment page

        // Example: Redirecting to the payment page URL
        return redirect($responseData['payment_url']);
    }
}
