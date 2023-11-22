<?php

/**
 * @package waad/zaincash
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Wallet Phone Number (MSISDN)
    |--------------------------------------------------------------------------
    |
    | The mobile phone number for your wallet, provided by Zain Cash.
    | Example format: 9647835077893.
    | The current number is for test purposes and only works in the test environment.
    | Replace it with your actual wallet number for production.
    */
    'msisdn' => env('ZAINCASH_MSISDN', '9647835077893'),

    /*
    |--------------------------------------------------------------------------
    | Merchant ID
    |--------------------------------------------------------------------------
    |
    | You can request a Merchant ID from ZainCash's support.
    | The current 'merchantid' is for test purposes and is only working in the test environment.
    | To use ZainCash in the production environment, replace this value with your actual Merchant ID.
    */
    'merchant_id' => env('ZAINCASH_MERCHANT_ID', '5ffacf6612b5777c6d44266f'),

    /*
    |--------------------------------------------------------------------------
    | Secret Hash
    |--------------------------------------------------------------------------
    |
    | This secret is used to decode and encode JWT during requests.
    | It must be requested from ZainCash.
    | The current secret is for test purposes and only works in the test environment.
    | Replace it with your actual secret for production.
    */
    'secret' => env('ZAINCASH_SECRET', '$2y$10$hBbAZo2GfSSvyqAyV2SaqOfYewgYpfR1O19gIh4SqyGWdmySZYPuS'),

    /*
    |--------------------------------------------------------------------------
    | Test Environment Mode
    |--------------------------------------------------------------------------
    |
    | Specify the environment for using the ZainCash API.
    | Set 'test' to false for the test environment or true for the live environment
    | after you have obtained all credentials from ZainCash.
    */
    'test' => env('ZAINCASH_TEST', true),
    'test_url' => env('ZAINCASH_TEST_URL', 'https://test.zaincash.iq/'),
    'live_url' => env('ZAINCASH_LIVE_URL', 'https://api.zaincash.iq/'),

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | Set the language for the ZainCash payment page.
    | Use 'ar' for Arabic or 'en' for English.
    */
    'language' => env('ZAINCASH_LANGUAGE', 'ar'),

    /*
    |--------------------------------------------------------------------------
    | Prefix Order ID
    |--------------------------------------------------------------------------
    |
    | prefix_order, you can use it to help you in tagging transactions with your website IDs.
    | If you have no order numbers in your website, you can leave it as a prefix or an identifier.
    | Example: 'palestine_free_' will result in order IDs like "wa3d_xxxxxxx".
    */
    'prefix_order_id' => env('ZAINCASH_PREFIX_ORDER_ID', 'wa3d_'),

    /*
    |--------------------------------------------------------------------------
    | IS Redirect & Redirect URL
    |--------------------------------------------------------------------------
    |
    | 'is_redirect' is used to specify whether or not to redirect to the ZainCash payment page.
    | 'is_redirect' if was `false` will ZainCash return a Transaction ID to the backend.
    | 'is_redirect' if was `true`, redirection after request to https://api.zaincash.iq/transaction/pay?id={TransactionId}.
    */
    'is_redirect' => env('ZAINCASH_IS_REDIRECT', false),

    /*
    |--------------------------------------------------------------------------
    | Minimum Amount
    |--------------------------------------------------------------------------
    |
    | Set the minimum amount for a valid transaction in Iraqi Dinar (IQD).
    | Transactions with amounts less than this value will be considered invalid.
    */
    'min_amount' => env('ZAINCASH_MIN_AMOUNT', 1000),

];
