<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderHistoryController extends Controller
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
            $view->with('titlePage',  $titlePage = trans('user.Order_History'));
            $view->with('activeOrderHistory',  $activeOrderHistory = true);
        });
    }


    public function index() {

        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('user.order-history.index', compact('orders'));
    }

    public function store_write_review(Request $request) {

        $request->validate([
            'order_id' => 'required|exists:orders,id|unique:reviews,order_id,', // |exists:reviews,id,where,0
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        Review::create([
            'order_id' => $request->order_id,
            'user_id' => Auth::user()->id,
            'service_id' => $request->service_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'is_publish' => false,
        ]);

        return response()->json(['success'=>trans('user.Your_Rating_was_sent_successfully')]);
    }
}
