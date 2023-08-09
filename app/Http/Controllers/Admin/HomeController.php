<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Dashboard'));
            $view->with('activeDashboard',  $activeDashboard = true);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersCount = User::get()->count();
        $ordersCount = Order::get()->count();
        $reviewsCount = Review::get()->count();
        $servicesCount = Service::get()->count();
        $newslettersCount = Newsletter::get()->count();
        $contactsCount = Contact::get()->count();

        $salesSum = Payment::get()->sum('amount');
//        $salesSum = Order::get()->sum('total');

        return view('admin.home', compact('usersCount', 'newslettersCount', 'contactsCount', 'ordersCount', 'reviewsCount', 'servicesCount', 'salesSum'));
    }
}
