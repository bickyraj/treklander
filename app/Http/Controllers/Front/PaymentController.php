<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Setting;
use App\Invoice;
use App\Services\Recaptcha\RecaptchaService;
use App\Trip;
use App\TripDeparture;
use Bickyraj\Hbl\Api\HblPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use DB;
use Error;


class PaymentController extends Controller
{
    public function payment()
    {
        return view('front.payment.payment');
    }

    public function storePayment(Request $request)
    {
        try {
            $trip = Trip::find($request->id);
            // save data to database.
            $invoice = new Invoice();
            $latest_invoice = DB::table('invoices')->latest('id')->first();
            $last_id = $latest_invoice ? $latest_invoice->id : 1;
            $invoice_number = str_pad($last_id, 5, "0", STR_PAD_LEFT);
            $invoice_id = 'IV-' . $invoice_number;
            $invoice->invoice_id = $invoice_id;
            $invoice->full_name = $request->first_name;
            // price is 25% of the booking amount
            $trip_offer_price = floatval($trip->offer_price);
            $trip_cost_price = floatval($trip->cost);
            $trip_price = ($trip_offer_price != 0) ? $trip_offer_price : $trip_cost_price;
            $price_after_percent = 0.25 * $trip_price * intval($request->no_of_travellers);
            $invoice->amount = $price_after_percent;
            $invoice->price = $price_after_percent;
            $invoice->trip_name = $trip->name;
            $invoice->email = $request->email;
            $invoice->contact_number = $request->contact_no;
            $invoice->ref_id = $invoice_number;
            $invoice->save();

            // payment
            $payment = [];
            $payment['formID'] = config('hbl.OfficeId');
            $payment['api_key'] = config('hbl.AccessToken');
            $payment['input_currency'] = config('hbl.InputCurrencty');
            $payment['merchant_id'] = config('hbl.OfficeId');
            $payment['input_amount'] = $invoice->amount;
            $payment['input_3d'] = config('hbl.Input3DS');
            $payment['simple_spc'] = config('hbl.OfficeId');
            $payment['fail_url'] = route('hbl.payment.failed');
            $payment['cancel_url'] = route('hbl.payment.canceled');
            $payment['success_url'] = route('front.payment.callback', ['invoceId' => $invoice->invoice_id]);
            $payment['backend_url'] = route('home');
            $payment['invoiceNo'] = $invoice->invoice_id;
            $payment['ref_id'] = $invoice->ref_id;
            //echo "Payment jose request \n ";
            $paymentObj = [
                "order_no" => $payment['ref_id'],
                "amount" => $payment['input_amount'],
                "success_url" => $payment['success_url'],
                "failed_url" => $payment['fail_url'],
                "cancel_url" => $payment['cancel_url'],
                "backend_url" => $payment['backend_url'],
                "custom_fields" => [
                    'RefID' => $payment['ref_id']
                ],
            ];

            HblPayment::pay($paymentObj);
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return redirect()->back();
        }
    }

    public function storePaymentFromFooter(Request $request)
    {
        try {
            // save data to database.
            $invoice = new Invoice();
            $latest_invoice = DB::table('invoices')->latest('id')->first();
            $last_id = $latest_invoice ? $latest_invoice->id : 1;
            $invoice_number = str_pad($last_id, 5, "0", STR_PAD_LEFT);
            $invoice_id = 'IV-' . $invoice_number;
            $invoice->invoice_id = $invoice_id;
            $invoice->full_name = $request->fullname;
            $price_float = floatval($request->price);
            $invoice->amount = $price_float;
            $invoice->price = $price_float;
            $invoice->trip_name = $request->trip_name;
            $invoice->email = $request->email;
            $invoice->contact_number = $request->contact_number;
            $invoice->ref_id = $invoice_number;
            $invoice->save();

            // payment
            $payment = [];
            $payment['formID'] = config('hbl.OfficeId');
            $payment['api_key'] = config('hbl.AccessToken');
            $payment['input_currency'] = config('hbl.InputCurrencty');
            $payment['merchant_id'] = config('hbl.OfficeId');
            $payment['input_amount'] = $invoice->amount;
            $payment['input_3d'] = config('hbl.Input3DS');
            $payment['simple_spc'] = config('hbl.OfficeId');
            $payment['fail_url'] = route('hbl.payment.failed');
            $payment['cancel_url'] = route('hbl.payment.canceled');
            $payment['success_url'] = route('front.payment.callback', ['invoceId' => $invoice->invoice_id]);
            $payment['backend_url'] = route('home');
            $payment['invoiceNo'] = $invoice->invoice_id;
            $payment['ref_id'] = $invoice->ref_id;
            $paymentObj = [
                "order_no" => $payment['ref_id'],
                "amount" => $payment['input_amount'],
                "success_url" => $payment['success_url'],
                "failed_url" => $payment['fail_url'],
                "cancel_url" => $payment['cancel_url'],
                "backend_url" => $payment['backend_url'],
                "custom_fields" => [
                    'RefID' => $payment['ref_id']
                ],
            ];
            HblPayment::pay($paymentObj);
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return redirect()->back();
        }
    }

    public function redeemPayment($id)
    {
        $invoice = Invoice::find($id);
        $payment = [];
        $payment['paymentGatewayID'] = config('constants.payment_merchant_id');
        $payment['invoiceNo'] = $invoice->invoice_id;
        $payment['productDesc'] = $invoice->trip_name;
        $payment['price'] =
        str_pad((float) $invoice->price * 100, 12, "0", STR_PAD_LEFT);
        $payment['currencyCode'] = "840";
        $payment['nonSecure'] = "N";
        $payment['hashValue'] = config('constants.payment_merchant_key');

        return view('front.payment.redeem_payment', compact('payment'));
    }

    public function paymentSuccess(Request $request)
    {
        $invoice = Invoice::where('ref_id', $request->orderNo)->first();
        $invoice->status = Invoice::PAID;
        $invoice->save();
        Session::flash('success_message', 'Payment successfull.');
        return redirect()->route('home');
    }

    public function paymentCanceled(Request $request)
    {
        $invoice = Invoice::where('ref_id', $request->orderNo)->first();
        $invoice->status = Invoice::CANCELED;
        $invoice->save();
        Session::flash('error_message', 'Payment Canceled. Please try again.');
        return redirect()->route('home');
    }

    public function paymentFailed(Request $request)
    {
        // update invoice data
        $invoice = Invoice::where('ref_id', $request->orderNo)->first();
        $invoice->status = Invoice::FAILED;
        $invoice->save();
        Session::flash('error_message', 'Payment failed. Please try again.');
        return redirect()->route('home');
    }

    public function makePayment()
    {
        return view('front.payment.payment');
    }

    public function callbackPayment(Request $request, $invoice_id)
    {
        try {
            $order_number = $request->orderNo;
            $product_description = $request->productDescription;
            $controller_internal_id = $request->controllerInternalId;
            $invoice = Invoice::where('invoice_id', $invoice_id)->first();
            $invoice->order_number = $order_number;
            $invoice->controller_internal_id = $controller_internal_id;
            if ($invoice->save()) {
                // send email to admin
                Mail::send('emails.payment-success', ['body' => [
                    'email' => $invoice->email,
                    'trip_name' => $invoice->trip_name,
                    'full_name' => $invoice->full_name,
                ]], function ($message) {
                    $message->to(Setting::get('email'));
                    $message->from(Setting::get('email'));
                    $message->subject('Trip Booking Payment');
                });
                return redirect('/');
            }
            throw new Error("Something went wrong. Please try again.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
