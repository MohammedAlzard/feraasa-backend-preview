<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Helpers\HelpersFun;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Mail\OrderCompleted;
use App\Mail\OrderReceived;
use App\Models\OrderAnswer;
use App\Repositories\OrderRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Response;

class OrderController extends AppBaseController
{
    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage', $titlePage = trans('admin.Orders'));
            $view->with('activeOrders', $activeOrders = true);
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

//        return $order->answer;

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

        /*if ($order->status == 'Done') {
            Flash::warning(trans('admin.Order_has_been_Completed'));
            return redirect(route('Admin::orders.index'));
        }*/

//        return $order;
//        return explode(',', $order->your_field1);

        if ($order->service_id == 1) {
            return view('admin.orders.edit-service-1')->with('order', $order);
        }

        if ($order->service_id == 2) {
            return view('admin.orders.edit-service-2')->with('order', $order);
        }

        if ($order->service_id == 3) {
            return view('admin.orders.edit-service-3')->with('order', $order);
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

//        return implode(',', $request->your_texts[1]);
//        return $request;

        if (empty($order)) {
            Flash::error(trans('admin.Order_not_found'));
            return redirect(route('Admin::orders.index'));
        }
        /*if ($request->status == 'On_Hold'){
            Flash::warning(trans('admin.Order_updated_successfully'));
            return redirect(route('Admin::orders.index'));
        }

        if ($order->status == 'Done') {
            Flash::warning(trans('admin.Order_has_been_Completed'));
            return redirect(route('Admin::orders.index'));
        }*/

        $order = $this->orderRepository->update($request->all(), $id);

        if ($order->service_id == 1) {
            $request->validate([
                'is_active_image' => 'required|string|in:1,0',
            ]);

            self::updateOrderForServiceFirst($order, $request);
        }

        if ($order->service_id == 2) {
            $request->validate([
                'is_active_image' => 'required|string|in:1,0',
            ]);
            self::updateOrderForServiceSecond($order, $request);
        }
        if ($order->service_id == 3) {

            self::updateOrderForServiceThird($order, $request);
        }


        if ($order->status != 'On_Hold'){
            try {
                $data = [
                    'title_service' => $order->service_title,
                    'status' => $order->status,
                    'total' => '$' . $order->total . ' USD',
                    'url' => url($order->answer->image),
                ];
                Mail::to($order->user->email)->send(new OrderCompleted($data));
            }catch (\Exception $exception){

            }
        }

        Flash::success(trans('admin.Order_updated_successfully'));

        return redirect(route('Admin::orders.index'));
    }

    public function updateOrderForServiceFirst($order, $request) {

        $order->update([
            'status' => $request->status, // Done or On_Hold
            'language' => $request->language, // en or ar
            'your_field1' => implode(',', $request->your_texts[1]),
            'your_field2' => implode(',', $request->your_texts[2]),
            'your_field3' => implode(',', $request->your_texts[3]),
            'your_field4' => implode(',', $request->your_texts[4]),
            'your_size1' => implode(',', $request->your_sizes[1]),
            'your_size2' => implode(',', $request->your_sizes[2]),
            'your_size3' => implode(',', $request->your_sizes[3]),
            'your_size4' => implode(',', $request->your_sizes[4]),
            'description' => $request->description,
        ]);
        HelpersFun::uploadFile($order, $request->your_image, 'your_image', 'admin/orders');
        $your_image = $order->your_image;
//        $your_image = $order->user->avatar;
        // $full_name = $order->user->first_name . ' ' . $order->user->last_name;

        $full_name = $order->orderServiceField->name ? $order->orderServiceField->name : 'null';

        $img = Image::make(public_path('uploads/order_answers/image-service-1.png'));

//        return $request;
        if ($request->is_active_image && !empty($your_image)) {
            // Star - Image Circle
            $imgCircle = Image::make(public_path($your_image)); # Create you image
            $imgCircle->fit(1000); # Apply a smart crop
            $canvas = Image::canvas(1000, 1000); # create empty canvas with transparent background
            $canvas->circle(1000, 500, 500, function ($draw) { # draw a black circle on it
                $draw->background('#000000');
            });
            $imgCircle->mask($canvas->encode('png', 75), true); # Mask your image with the shape
            // End - Image Circle

            $erweimaimage = Image::make($imgCircle)->resize(240, 240);
            $img->insert($erweimaimage, 'top', 0, 355);
        }

        $Arabic = new \I18N_Arabic('Glyphs');
//        $text = 'مسالم';
//        $text = $Arabic->utf8Glyphs($text);

        $name = $Arabic->utf8Glyphs($full_name);
        $img->text($name, 500, 680, function ($font) {
            $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(30);
            $font->color('#ffffff');
            $font->align('center');
            $font->angle(0);
        });
//        return $img->response('png');

        $your_texts = $request->your_texts;
        $your_sizes = $request->your_sizes;

        $xArray = [
            1 => [955, 955, 955, 955, 955],
            2 => [45, 45, 45, 45, 45],
            3 => [955, 955, 955, 955, 955],
            4 => [45, 45, 45, 45, 45]
        ];
        $yArray = [1 => 190, 2 => 190, 3 => 525, 4 => 525];
        for ($i = 1; $i <= 4; $i++) {
            for ($x = 0; $x < count($your_texts[$i]); $x++) {
                if (!empty($your_texts[$i][$x])) {
                    $text = $Arabic->utf8Glyphs($your_texts[$i][$x]);
                    $fontsize = $your_sizes[$i][$x];
                    // $img->text($text, $xArray[$i][$x], $yArray[$i], function ($font, $size = 28) {
                    // $img->text($text, $xArray[$i][$x], $yArray[$i], function($font) use($fontsize){

                    $align = ($i == 1 || $i == 3) ? 'right' : 'left';
                    $img->text($text, $xArray[$i][$x], $yArray[$i], function($font) use($fontsize, $align){
                        $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                        $font->size($fontsize);
                        $font->color('#ffffff');
                        $font->align($align);
//                        $font->valign('top');
                        $font->angle(0);
                    });
                    $yArray[$i] += 60;
                }
            }
        }

        // Add Description
        $margin  = 50;
        $fontSize = 28;
        $lineHeight = 45;
        $fontColor = '#ffffff';
        $description = $request->language == 'ar' ? $Arabic->utf8Glyphs($request->description,77) : $request->description;

        if ($request->language == 'ar') {  # Arabic

            $lines = explode("\n", $description);
            $textHeight = count($lines) * $lineHeight;
            $textY = 938;
            foreach ($lines as $line) {
                $img->text($line,$img->width() -  $margin, $textY, function ($font) use ($fontSize, $fontColor){
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('right');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            }


            /*for ($i = 0; $i < count($lines); $i++) {
                $offset = 940 + ($i * 45); // 50 is line height
                $img->text($lines[$i], 510, $offset, function ($font) {
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size(30);
                    $font->color('#ffffff');
                    $font->align('center');
                    $font->angle(0);
                });
            }*/
        } else { # English
//            $description = $request->description;
            /*$lines = explode("\n", wordwrap($description, 75));
            for ($i = 0; $i < count($lines); $i++) {
                $offset = 1125 + ($i * 45); // 50 is line height
                $img->text($lines[$i], 20, $offset, function ($font) {
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size(30);
                    $font->color('#000000');
                    $font->angle(0);
                });
            }*/


            $margin = 960;
            $lineHeight = 40;

//            $wrappedText = wordwrap($description,2.2*(($img->width() - 2 * $margin) / $fontSize) , "\n");
            $wrappedText = wordwrap($description,2.2*(($img->width() - 70) / $fontSize) , "\n");
            $lines = explode("\n", $wrappedText);
//            return $lines;
            $textHeight = count($lines) * $lineHeight;
            $textY = 940;

//            return $lines;
            foreach ($lines as $line) {
                $img->text($line, $img->width() - $margin, $textY, function ($font) use ($fontSize, $fontColor) {
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('left');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            }
        }

//        $img->save(public_path('uploads/order_answers/test.jpg'));
        $file_name = time() . uniqid() . '.jpg';
        $img->save(public_path('uploads/order_answers/images/'.$file_name));
//        return $img->response('jpg');

        /*$order = $this->orderRepository->update($request->all(), $id);
        $order->update([
            'status' => $request->status, // Done or On_Hold
            'language' => $request->language, // en or ar
            'your_field1' => implode(',', $request->your_texts[1]),
            'your_field2' => implode(',', $request->your_texts[2]),
            'your_field3' => implode(',', $request->your_texts[3]),
            'your_field4' => implode(',', $request->your_texts[4]),
            'your_size1' => implode(',', $request->your_sizes[1]),
            'your_size2' => implode(',', $request->your_sizes[2]),
            'your_size3' => implode(',', $request->your_sizes[3]),
            'your_size4' => implode(',', $request->your_sizes[4]),
            'description' => $request->description,
        ]);*/

        OrderAnswer::where('order_id', $order->id)->delete();
        $orderAnswer = OrderAnswer::create([
            'order_id' => $order->id,
            'image' => '/uploads/order_answers/images/'.$file_name,
            'report_id' => uniqid(),
        ]);

        return true;
    }

    public function updateOrderForServiceSecond($order, $request) {

        $order->update([
            'status' => $request->status, // Done or On_Hold
            'language' => $request->language, // en or ar
            'your_field1' => implode(',', $request->your_texts[1]),
            'your_field2' => implode(',', $request->your_texts[2]),
            'your_field3' => implode(',', $request->your_texts[3]),
            'your_field4' => implode(',', $request->your_texts[4]),
            'your_size1' => implode(',', $request->your_sizes[1]),
            'your_size2' => implode(',', $request->your_sizes[2]),
            'your_size3' => implode(',', $request->your_sizes[3]),
            'your_size4' => implode(',', $request->your_sizes[4]),

            'other_field1' => implode(',', $request->other_texts[1]),
            'other_field2' => implode(',', $request->other_texts[2]),
            'other_field3' => implode(',', $request->other_texts[3]),
            'other_field4' => implode(',', $request->other_texts[4]),
            'other_size1' => implode(',', $request->other_sizes[1]),
            'other_size2' => implode(',', $request->other_sizes[2]),
            'other_size3' => implode(',', $request->other_sizes[3]),
            'other_size4' => implode(',', $request->other_sizes[4]),

            'description' => $request->description,
        ]);
        HelpersFun::uploadFile($order, $request->your_image, 'your_image', 'admin/orders');
        HelpersFun::uploadFile($order, $request->other_image, 'other_image', 'admin/orders');
        $your_image = $order->your_image;
        $other_image = $order->other_image;
//        $your_image = $order->user->avatar;
        // $full_name = $order->user->first_name . ' ' . $order->user->last_name;
        $full_name = $order->orderServiceField->name ? $order->orderServiceField->name : 'null';

        $img = Image::make(public_path('uploads/order_answers/image-service-2.jpg'));

        // Your Image
        if ($request->is_active_image && !empty($your_image)) {
            // Star - Image Circle
            $imgCircle = Image::make(public_path($your_image)); # Create you image
            $imgCircle->fit(1000); # Apply a smart crop
            $canvas = Image::canvas(1000, 1000); # create empty canvas with transparent background
            $canvas->circle(1000, 500, 500, function ($draw) { # draw a black circle on it
                $draw->background('#000000');
            });
            $imgCircle->mask($canvas->encode('png', 75), true); # Mask your image with the shape
            // End - Image Circle

            $erweimaimage = Image::make($imgCircle)->resize(155, 155);
            $img->insert($erweimaimage, 'top-left', 349, 319);
        }
//        return $img->response('png');

        // Other Image
        if ($request->is_active_image && !empty($request->other_image)) {
            // Star - Image Circle
            $imgCircle = Image::make(public_path($other_image)); # Create you image
            $imgCircle->fit(1000); # Apply a smart crop
            $canvas = Image::canvas(1000, 1000); # create empty canvas with transparent background
            $canvas->circle(1000, 500, 500, function ($draw) { # draw a black circle on it
                $draw->background('#000000');
            });
            $imgCircle->mask($canvas->encode('png', 75), true); # Mask your image with the shape
            // End - Image Circle

            $erweimaimage = Image::make($imgCircle)->resize(155, 155);
            $img->insert($erweimaimage, 'top-left', 511, 319);
        }

//        return $img->response('png');

        $Arabic = new \I18N_Arabic('Glyphs');
//        $text = 'مسالم';
//        $text = $Arabic->utf8Glyphs($text);

        /*$name = $Arabic->utf8Glyphs($full_name);
        $img->text($name, 500, 680, function ($font) {
            $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(30);
            $font->color('#ffffff');
            $font->align('center');
            $font->angle(0);
        });*/
//        return $img->response('png');


        $match_ratio = $request->match_ratio.'%';
        $img->text($match_ratio, 515, 750, function ($font) {
            $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
            $font->size(72);
            $font->color('#ffffff');
            $font->align('center');
            $font->angle(0);
        });
//        return $img->response('png');


        // Your Texts
        $your_texts = $request->your_texts;
        $your_sizes = $request->your_sizes;
        $xArray = [
            1 => [960, 960, 960, 960, 960],
            2 => [55, 55, 55, 55, 55],
            3 => [960, 960, 960, 960, 960],
            4 => [55, 55, 55, 55, 55]
        ];
        $yArray = [1 => 75, 2 => 75, 3 => 295, 4 => 295];
        for ($i = 1; $i <= 4; $i++) {
            for ($x = 0; $x < count($your_texts[$i]); $x++) {
                if (!empty($your_texts[$i][$x])) {
                    $text = $Arabic->utf8Glyphs($your_texts[$i][$x]);
                    $fontsize = $your_sizes[$i][$x];
                    // $img->text($text, $xArray[$i][$x], $yArray[$i], function ($font, $size = 28) {
                    $align = ($i == 1 || $i == 3) ? 'right' : 'left';
                    $img->text($text, $xArray[$i][$x], $yArray[$i], function($font) use($fontsize, $align){
                        $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                        $font->size($fontsize);
                        $font->color('#ffffff');
                        $font->align($align);
                        $font->valign('top');
                        $font->angle(0);
                    });
                    $yArray[$i] += 30;
                }
            }
        }


        // Other Texts
        $other_texts = $request->other_texts;
        $other_sizes = $request->other_sizes;
        $xArray = [
            1 => [960, 960, 960, 960, 960],
            2 => [55, 55, 55, 55, 55],
            3 => [960, 960, 960, 960, 960],
            4 => [55, 55, 55, 55, 55]
        ];
        $yArray = [1 => 520, 2 => 520, 3 => 738, 4 => 738];
        for ($i = 1; $i <= 4; $i++) {
            for ($x = 0; $x < count($other_texts[$i]); $x++) {
                if (!empty($other_texts[$i][$x])) {
                    $text = $Arabic->utf8Glyphs($other_texts[$i][$x]);
                    $fontsize = $other_sizes[$i][$x];
                    $align = ($i == 1 || $i == 3) ? 'right' : 'left';
                    // $img->text($text, $xArray[$i][$x], $yArray[$i], function ($font, $size = 28) {
                    $img->text($text, $xArray[$i][$x], $yArray[$i], function($font) use($fontsize, $align){
                        $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                        $font->size($fontsize);
                        $font->color('#ffffff');
                        $font->align($align);
                        $font->valign('top');
                        $font->angle(0);
                    });
                    $yArray[$i] += 30;
                }
            }
        }

        // Add Description
        $margin  = 20;
        $fontSize = 28;
        $lineHeight = 50;
        $fontColor = '#ffffff';
        $description = $request->language == 'ar' ? $Arabic->utf8Glyphs($request->description,77) : $request->description;

        if ($request->language == 'ar') {  # Arabic

            $lines = explode("\n", $description);
            $textHeight = count($lines) * $lineHeight;
            $textY = 920;
            foreach ($lines as $line) {
                $img->text($line,$img->width() -  $margin, $textY, function ($font) use ($fontSize, $fontColor){
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('right');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            }
        } else { # English

            $margin = 960;
            $lineHeight = 40;

//            $wrappedText = wordwrap($description,2.2*(($img->width() - 2 * $margin) / $fontSize) , "\n");
            $wrappedText = wordwrap($description,2.2*(($img->width() - 50) / $fontSize) , "\n");
            $lines = explode("\n", $wrappedText);
            $textHeight = count($lines) * $lineHeight;
            $textY = 920;

            foreach ($lines as $line) {
                $img->text($line, $img->width() - $margin, $textY, function ($font) use ($fontSize, $fontColor) {
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('left');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            }
        }

//        $img->save(public_path('uploads/order_answers/test.jpg'));
        $file_name = time() . uniqid() . '.jpg';
        $img->save(public_path('uploads/order_answers/images/'.$file_name));
//        return $img->response('jpg');

        /*$order = $this->orderRepository->update($request->all(), $id);
        $order->update([
            'status' => $request->status, // Done or On_Hold
            'language' => $request->language, // en or ar
            'your_field1' => implode(',', $request->your_texts[1]),
            'your_field2' => implode(',', $request->your_texts[2]),
            'your_field3' => implode(',', $request->your_texts[3]),
            'your_field4' => implode(',', $request->your_texts[4]),
            'your_size1' => implode(',', $request->your_sizes[1]),
            'your_size2' => implode(',', $request->your_sizes[2]),
            'your_size3' => implode(',', $request->your_sizes[3]),
            'your_size4' => implode(',', $request->your_sizes[4]),
            'description' => $request->description,
        ]);*/

        OrderAnswer::where('order_id', $order->id)->delete();
        $orderAnswer = OrderAnswer::create([
            'order_id' => $order->id,
            'image' => '/uploads/order_answers/images/'.$file_name,
            'report_id' => uniqid(),
        ]);

        return true;
    }

    public function updateOrderForServiceThird($order, $request) {

        $order->update([
            'status' => $request->status, // Done or On_Hold
            'language' => $request->language, // en or ar
            'description' => $request->description,
        ]);
        // $full_name = $order->user->first_name . ' ' . $order->user->last_name;
        $full_name = $order->orderServiceField->name ? $order->orderServiceField->name : 'null';

        $img = Image::make(public_path('uploads/order_answers/image-service-3.jpg'));

        $Arabic = new \I18N_Arabic('Glyphs');

        // Add Description
        $margin  = 160;
        $fontSize = 48;
        $lineHeight = 70;
        $fontColor = '#ffffff';
        $description = $request->language == 'ar' ? $Arabic->utf8Glyphs($request->description,70) : $request->description;
        $dream_description = $request->language == 'ar' ? $Arabic->utf8Glyphs($order->orderServiceField->dream_description,70) : $order->orderServiceField->dream_description;

        if ($request->language == 'ar') {  # Arabic

            // Dream Description
            $lines = explode("\n", $dream_description);
            $textHeight = count($lines) * $lineHeight;
            $textY = 455;
            foreach ($lines as $line) {
                $img->text($line,$img->width() -  $margin, $textY, function ($font) use ($fontSize, $fontColor){
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('right');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            } // End - Dream Description

            // Description
            $lines = explode("\n", $description);
            $textHeight = count($lines) * $lineHeight;
            $textY = 1280;
            foreach ($lines as $line) {
                $img->text($line,$img->width() -  $margin, $textY, function ($font) use ($fontSize, $fontColor){
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('right');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            } // End - Description
        } else { # English

            $margin = 1460;
            $lineHeight = 70;

            // Dream Description
            $wrappedText = wordwrap($dream_description,2.2*(($img->width() - 250) / $fontSize) , "\n");
            $lines = explode("\n", $wrappedText);
            $textHeight = count($lines) * $lineHeight;
            $textY = 460;
            foreach ($lines as $line) {
                $img->text($line,$img->width() -  $margin, $textY, function ($font) use ($fontSize, $fontColor){
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('left');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            } // End - Dream Description

//            $wrappedText = wordwrap($description,2.2*(($img->width() - 2 * $margin) / $fontSize) , "\n");
            $wrappedText = wordwrap($description,2.2*(($img->width() - 250) / $fontSize) , "\n");
            $lines = explode("\n", $wrappedText);
            $textHeight = count($lines) * $lineHeight;
            $textY = 1280;

            foreach ($lines as $line) {
                $img->text($line, $img->width() - $margin, $textY, function ($font) use ($fontSize, $fontColor) {
                    $font->file(base_path('public/uploads/order_answers/fonts/DINNextLTArabic-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color($fontColor);
                    $font->align('left');
                    $font->valign('top');
                    $font->angle(0);
                });
                $textY += $lineHeight;
            }
        }

//        $img->save(public_path('uploads/order_answers/test.jpg'));
        $file_name = time() . uniqid() . '.jpg';
        $img->save(public_path('uploads/order_answers/images/'.$file_name));
//        return $img->response('png');

        OrderAnswer::where('order_id', $order->id)->delete();
        $orderAnswer = OrderAnswer::create([
            'order_id' => $order->id,
            'image' => '/uploads/order_answers/images/'.$file_name,
            'report_id' => uniqid(),
        ]);

        return true;
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
