<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save users data kecuali total price
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // proses checkout
        $code = 'STORE-' . mt_rand(000000,999999);
        $carts = Cart::with(['product','user'])
        ->where('users_id', Auth::user()->id)
        ->get();

        // transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => (int) $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        // for detail
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // konfigurasi midtrans
        // Set your Merchant Server Key
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            // buat array untuk dikirim ke midtrans
            $midtrans = [
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => (int) $request->total_price,
                ],
                'customer_detail' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'vtweb' => []
            ];

            try {
                // Get Snap Payment Page URL
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

                // Redirect to Snap Payment Page
                return redirect($paymentUrl);
                }
                catch (Exception $e) {
                echo $e->getMessage();
            }
        
    }

    public function callback(Request $request)
    {

    }
}
