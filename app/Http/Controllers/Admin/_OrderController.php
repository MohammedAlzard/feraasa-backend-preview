<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Response;

class OrderController extends AppBaseController
{
    /** @var OrderRepository $orderRepository*/
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Orders'));
            $view->with('activeOrders',  $activeOrders = true);
        });
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     *
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success(trans('admin.Order_saved_successfully'));

        return redirect(route('Admin::orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(trans('admin.Order_not_found'));

            return redirect(route('Admin::orders.index'));
        }

        return view('admin.orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(trans('admin.Order_not_found'));

            return redirect(route('Admin::orders.index'));
        }

        return view('admin.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(trans('admin.Order_not_found'));
            return redirect(route('Admin::orders.index'));
        }


//        return $request;

        $user = $order->user;
        $avatar = $user->avatar;
        $full_name = $user->first_name . ' ' . $user->last_name;

        // Star - Image Circle
        $imgCircle = Image::make(public_path($avatar)); # Create you image
        $imgCircle->fit(1000); # Apply a smart crop
        $canvas = Image::canvas(1000, 1000); # create empty canvas with transparent background
        $canvas->circle(1000, 500, 500, function ($draw) { # draw a black circle on it
            $draw->background('#000000');
        });
        $imgCircle->mask($canvas->encode('png', 75), true); # Mask your image with the shape
        // End - Image Circle

        $Arabic = new \I18N_Arabic('Glyphs');
//        $text = 'مسالم';
//        $text = $Arabic->utf8Glyphs($text);

        $img = Image::make(public_path('images/image.png'));

//        $erweimaimage = Image::make($imgCircle)->resize(180, 180);
//        $img->insert($erweimaimage, 'top', 0, 400);

        $name = $Arabic->utf8Glyphs($full_name);
        $img->text($name, 535, 640, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(30);
            $font->color('#ffffff');
            $font->align('center');
            $font->angle(0);
        });
//        return $img->response('png');



        $text_1_1 = $Arabic->utf8Glyphs($request->text_1_1);
        $img->text($text_1_1, 930, 450, function($font, $size = 28) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size($size);
            $font->color('#ffffff');
            $font->align('center');
//            $font->valign('bottom');
//            $font->angle(0);
        });
        $text_1_2 = $Arabic->utf8Glyphs($request->text_1_2);
        $img->text($text_1_2, 840, 500, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(28);
            $font->color('#ffffff');
            $font->align('center');
        });
        $text_1_3 = $Arabic->utf8Glyphs($request->text_1_3);
        $img->text($text_1_3, 970, 550, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(28);
            $font->color('#ffffff');
            $font->align('center');
        });
        $text_1_4 = $Arabic->utf8Glyphs($request->text_1_4);
        $img->text($text_1_4, 890, 600, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(28);
            $font->color('#ffffff');
            $font->align('center');
        });
        $text_1_5 = $Arabic->utf8Glyphs($request->text_1_5);
        $img->text($text_1_5, 950, 650, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(28);
            $font->color('#ffffff');
            $font->align('center');
        });

        // Add Description
        $description = $Arabic->utf8Glyphs($request->description);
        $img->text($description, 20, 1110, function($font) {
            $font->file(base_path('public/images/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(22);
            $font->color('#d70000');
            $font->align('justify');
//            $font->valign('bottom');
//            $font->valign('center');
            $font->angle(0);
        });

        $img->save(public_path('images/test.jpg'));

        return $img->response('jpg');




        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success(trans('admin.Order_updated_successfully'));

        return redirect(route('Admin::orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error(trans('admin.Order_not_found'));

            return redirect(route('Admin::orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success(trans('admin.Order_deleted_successfully'));

        return redirect(route('Admin::orders.index'));
    }
}
