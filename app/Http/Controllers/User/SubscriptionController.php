<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class SubscriptionController extends Controller
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
            $view->with('titlePage',  $titlePage = trans('user.Subscriptions'));
            $view->with('activeSubscriptions',  $activeSubscriptions = true);
        });
    }

    public function index() {

        $subscriptions = Subscription::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('user.subscriptions.index', compact('subscriptions'));
    }


    public function cancel($id) {

        $subscription = Subscription::where('user_id', Auth::user()->id)->active()->find($id);
        if (empty($subscription) && empty($subscription->service)) {
            Flash::error(trans('user.Subscription_not_found'));
            return redirect(route('User::subscriptions.index'));
        }
        $service = $subscription->service;

        $user = Auth::user();
        $user->subscription($service->slug)->cancelNow();

        $subscription->update([
            'is_active' => false,
            'ends_at' => Carbon::now()
        ]);

        Flash::success(trans('user.Subscription_cancel_successfully'));
        return redirect(route('User::subscriptions.index'));
    }

}
