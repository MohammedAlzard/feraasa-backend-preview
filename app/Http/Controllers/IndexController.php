<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMail;
use App\Mail\OrderService;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\OrderAnswer;
use App\Models\Review;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    public function index() {
        $isActiveHomePage = true;

        $testimonials = Testimonial::active()->orderBy('order_by', 'ASC')->get();
        $services = Service::active()->orderBy('order_by', 'ASC')->get();

        return view('index', compact('isActiveHomePage', 'testimonials', 'services'));
    }

    public function about(){

        $isActiveAboutPage = true;

        return view('about', compact('isActiveAboutPage'));
    }

    public function services(){

        $isActiveServicesPage = true;
        $services = Service::active()->orderBy('order_by', 'ASC')->get();

        return view('services', compact('isActiveServicesPage', 'services'));
    }

    public function service_details($slug){

        $isActiveServicesPage = true;

        $service = Service::active()->where('slug', $slug)->first();
        if (empty($service)) {
            return redirect('/services');
        }

        return view('service-details', compact('isActiveServicesPage', 'service'));
    }
    
    // this for Contact Us Page
    public function contact(){
        $isActiveContactPage = true;

        return view('contact', compact('isActiveContactPage'));
    }
    public function store_contact(StoreContactRequest $request){

        $data = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false,
        ]);

        try {
            Mail::to('alferaasa@gmail.com')->send(new  ContactMail($data));
        }catch (\Exception $exception){

        }

        return response()->json(['success'=>trans('site.Your_message_was_sent_successfully')]);
    }


    public function reviews(Request $request) {

        $isActiveReviewsPage = true;
        $request->validate([
            'filter' => 'nullable|exists:services,slug',
        ]);

        if (isset($request->filter)) {
            $service = Service::where('slug', $request->filter)->first();
            $reviews = Review::publish()->where('service_id', $service->id)->orderBy('created_at', 'DESC')->paginate(5);
        }else{
            $reviews = Review::publish()->orderBy('created_at', 'DESC')->paginate(5);
        }

        $services = Service::get();
        return view('reviews', compact('reviews', 'services', 'isActiveReviewsPage'));
    }

    public function report_view($report_id) {

        $report = OrderAnswer::where('report_id', $report_id)->first();
        if (empty($report)) {
            return redirect('/');
        }

        return view('report-view', compact('report'));
    }
}
