<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Response;

class CouponController extends AppBaseController
{
    /** @var CouponRepository $couponRepository*/
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Coupons'));
            $view->with('activeCoupons',  $activeCoupons = true);
        });
    }

    /**
     * Display a listing of the Coupon.
     *
     * @param CouponDataTable $couponDataTable
     *
     * @return Response
     */
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('admin.coupons.index');
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        Flash::success('Coupon saved successfully.');

        return redirect(route('Admin::coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('Admin::coupons.index'));
        }

        return view('admin.coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('Admin::coupons.index'));
        }

        return view('admin.coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);
        $request->validate([
//            'code' => 'required|string|min:4|max:191|unique:coupons,code'. $id,
        ]);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('Admin::coupons.index'));
        }

        $coupon = $this->couponRepository->update($request->all(), $id);

        Flash::success('Coupon updated successfully.');

        return redirect(route('Admin::coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('Admin::coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success('Coupon deleted successfully.');

        return redirect(route('Admin::coupons.index'));
    }
}
