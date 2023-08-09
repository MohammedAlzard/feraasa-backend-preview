<?php

namespace App\Http\Controllers\User;

use App\Helpers\HelpersFun;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use PHPUnit\Exception;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class HomeController extends Controller
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
            $view->with('titlePage',  $titlePage = trans('user.Home'));
            $view->with('activeHome',  $activeHome = true);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        return Session::get('service_for_login');
        if (Session::has('service_for_login')) {
            $slug = Session::get('service_for_login.slug');
            $btn = Session::get('service_for_login.btn');
            Session::forget('service_for_login');
            return redirect('/services/'.$slug.'/'.$btn);
        }

        $activeHome = true;

        $services = Service::active()->orderBy('order_by', 'ASC')->get();
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->limit(3)->get();
        $subscriptionsCount = Subscription::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get()->count();
        $ordersCount = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get()->count();
        $ordersOn_HoldCount = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->where('status', 'On_Hold')->get()->count();


        $total_Payments = DB::table('orders')
            ->where('user_id', Auth::user()->id)
            ->join('payments','payments.order_id', '=', 'orders.id')
            ->get()->sum('total');


        return view('user.home', compact('activeHome', 'services', 'orders', 'subscriptionsCount', 'ordersCount', 'ordersOn_HoldCount', 'total_Payments'));
    }

}
