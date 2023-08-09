<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentMethodController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
        View::composer('*', function ($view) {
            $view->with('titlePage', $titlePage = trans('user.PaymentMethods'));
            $view->with('activePaymentMethods', $activePaymentMethods = true);
        });
    }

    public function index()
    {
        $user = Auth::user();
        $paymentMethod = $user->paymentMethod;

        return view('user.payment-methods.index', compact('paymentMethod'));
    }

    public function create()
    {
        return view('user.payment-methods.create');
    }

    public function checkout(Request $request){

        $user = Auth::user();

        if (!empty($user->paymentMethod)) {
            $user->paymentMethod->update([
                'is_active' => false,
            ]);
            $user->deletePaymentMethods();
        }
        $paymentMethod = $user->addPaymentMethod($request->pmethod);

        $pm_id = $paymentMethod->id;
        $exp_month = $paymentMethod->card->exp_month;
        $exp_year = $paymentMethod->card->exp_year;
        $last4 = $paymentMethod->card->last4;
        $customer = $paymentMethod->customer;

        \App\Models\PaymentMethod::create([
            'user_id' => $user->id,
            'pm_id' => $pm_id,
            'customer_id' => $customer,
            'card_name' => Str::upper($request->card_name),
            'card_number' => '**** **** **** ' . $last4,
            'card_expiry_month' => $exp_month,
            'card_expiry_year' => $exp_year,
            'payment_method' => 'stripe',
            'is_active' => true,
        ]);

        Flash::success(trans('user.Card_saved_successfully'));
        return redirect(route('User::payment-methods.index'));
    }
}
