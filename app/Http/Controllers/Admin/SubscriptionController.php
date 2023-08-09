<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriptionDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Response;

class SubscriptionController extends AppBaseController
{
    /** @var SubscriptionRepository $subscriptionRepository*/
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepository = $subscriptionRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Subscriptions'));
            $view->with('activeSubscriptions',  $activeSubscriptions = true);
        });
    }

    /**
     * Display a listing of the Subscription.
     *
     * @param SubscriptionDataTable $subscriptionDataTable
     *
     * @return Response
     */
    public function index(SubscriptionDataTable $subscriptionDataTable)
    {
        return $subscriptionDataTable->render('admin.subscriptions.index');
    }

    /**
     * Show the form for creating a new Subscription.
     *
     * @return Response
     */
    public function create()
    {
        return redirect(route('Admin::subscriptions.index'));
        return view('admin.subscriptions.create');
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param CreateSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriptionRequest $request)
    {
        return redirect(route('Admin::subscriptions.index'));
        $input = $request->all();

        $subscription = $this->subscriptionRepository->create($input);

        Flash::success('Subscription saved successfully.');

        return redirect(route('Admin::subscriptions.index'));
    }

    /**
     * Display the specified Subscription.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error('Subscription not found');

            return redirect(route('Admin::subscriptions.index'));
        }

        return view('admin.subscriptions.show')->with('subscription', $subscription);
    }

    /**
     * Show the form for editing the specified Subscription.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return redirect(route('Admin::subscriptions.index'));
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error('Subscription not found');

            return redirect(route('Admin::subscriptions.index'));
        }

        return view('admin.subscriptions.edit')->with('subscription', $subscription);
    }

    /**
     * Update the specified Subscription in storage.
     *
     * @param int $id
     * @param UpdateSubscriptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriptionRequest $request)
    {
        return redirect(route('Admin::subscriptions.index'));
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error('Subscription not found');

            return redirect(route('Admin::subscriptions.index'));
        }

        $subscription = $this->subscriptionRepository->update($request->all(), $id);

        Flash::success('Subscription updated successfully.');

        return redirect(route('Admin::subscriptions.index'));
    }

    /**
     * Remove the specified Subscription from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error('Subscription not found');

            return redirect(route('Admin::subscriptions.index'));
        }

//        $this->subscriptionRepository->delete($id);

        $service = $subscription->service;
        $user = $subscription->user;
        $user->subscription($service->slug)->cancelNow();
        $subscription->update([
            'is_active' => false,
            'ends_at' => Carbon::now()
        ]);

        Flash::success('Subscription deleted successfully.');

        return redirect(route('Admin::subscriptions.index'));
    }
}
