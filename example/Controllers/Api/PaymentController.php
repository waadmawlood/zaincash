<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\InitialPaymentRequest;
use Illuminate\Support\Str;
use Waad\ZainCash\Facades\ZainCash;

class PaymentController extends Controller
{
    /**
     * Create Request Transaction
     *
     * @param InitialPaymentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function initialTransaction(InitialPaymentRequest $request)
    {
        // without facade
        // use Waad\ZainCash\ZainCash;
        // $zainCashPayment = ZainCash::make()
        //     ->setAmount($request->amount)
        //     ->setServiceType('Book')
        //     ->setOrderId(Str::random(36))
        //     ->setIsTest(true)
        //     ->setIsReturnArray(true);
        // return response()->json($zainCashPayment->createTransaction());

        // with facade
        $zainCashPayment = ZainCash::setAmount($request->amount)
            ->setServiceType('Book')
            ->setOrderId(Str::random(36))
            ->setIsTest(true)
            ->setIsReturnArray(true);

        return response()->json($zainCashPayment->createTransaction());
    }

    /**
     * Check Transaction ID
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTransaction(string $id)
    {
        // without facade
        // use Waad\ZainCash\ZainCash;
        // $zainCashPayment = ZainCash::make()
        //     ->setTransactionID($id)
        //     ->setIsRedirect(false)
        //     ->setIsTest(true)
        //     ->setIsReturnArray(true);
        // return response()->json($zainCashPayment->checkTransaction());

        // with facade
        $zainCashPayment = ZainCash::setTransactionID($id)
            ->setIsRedirect(false)
            ->setIsTest(true)
            ->setIsReturnArray(true);

        return response()->json($zainCashPayment->checkTransaction());
    }

    /**
     * Processing Transaction
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function processingTransaction(string $id)
    {
        // without facade
        // use Waad\ZainCash\ZainCash;
        // $zainCashPayment = ZainCash::make()
        //     ->setTransactionID($id)
        //     ->setIsRedirect(false)
        //     ->setIsTest(true)
        //     ->setIsReturnArray(true);
        // return response()->json($zainCashPayment->processingTransaction("9647802999569", '1234'));

        // with facade
        $zainCashPayment = ZainCash::setTransactionID($id)
            ->setIsRedirect(false)
            ->setIsTest(true)
            ->setIsReturnArray(true);

        return response()->json($zainCashPayment->processingTransaction("9647802999569", '1234'));
    }

    /**
     * Pay Transaction
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function payTransaction(string $id)
    {
        // without facade
        // use Waad\ZainCash\ZainCash;
        // $zainCashPayment = ZainCash::make()
        //     ->setTransactionID($id)
        //     ->setIsRedirect(false)
        //     ->setIsTest(true)
        //     ->setIsReturnArray(true);
        // return response()->json($zainCashPayment->payTransaction("9647802999569", '1234', '1111'));

        // with facade
        $zainCashPayment = ZainCash::setTransactionID($id)
            ->setIsRedirect(false)
            ->setIsTest(true)
            ->setIsReturnArray(true);

        return response()->json($zainCashPayment->payTransaction("9647802999569", '1234', '1111'));
    }

    /**
     * Cancel Transaction
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelTransaction(string $id)
    {
        // without facade
        // use Waad\ZainCash\ZainCash;
        // $zainCashPayment = ZainCash::make()
        //     ->setTransactionID($id)
        //     ->setIsRedirect(false)
        //     ->setIsTest(true)
        //     ->setIsReturnArray(true);
        // return response()->json($zainCashPayment->cancelTransaction());

        // with facade
        $zainCashPayment = ZainCash::setTransactionID($id)
            ->setIsRedirect(false)
            ->setIsTest(true)
            ->setIsReturnArray(true);

        return response()->json($zainCashPayment->cancelTransaction());
    }
}
