<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HelpersFun;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Repositories\TestimonialRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class TestimonialController extends AppBaseController
{
    /** @var TestimonialRepository $testimonialRepository*/
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepository = $testimonialRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Testimonials'));
            $view->with('activeTestimonials',  $activeTestimonials = true);
        });
    }

    /**
     * Display a listing of the Testimonial.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $testimonials = $this->testimonialRepository->all();

        return view('admin.testimonials.index')
            ->with('testimonials', $testimonials);
    }

    /**
     * Show the form for creating a new Testimonial.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param CreateTestimonialRequest $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepository->create($input);
        HelpersFun::uploadFile($testimonial, $request->image, 'image', 'admin/testimonials');

        Flash::success(trans('admin.Testimonial_saved_successfully'));

        return redirect(route('Admin::testimonials.index'));
    }

    /**
     * Display the specified Testimonial.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error(trans('admin.Testimonial_not_found'));

            return redirect(route('Admin::testimonials.index'));
        }

        return view('admin.testimonials.show')->with('testimonial', $testimonial);
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error(trans('admin.Testimonial_not_found'));

            return redirect(route('Admin::testimonials.index'));
        }

        return view('admin.testimonials.edit')->with('testimonial', $testimonial);
    }

    /**
     * Update the specified Testimonial in storage.
     *
     * @param int $id
     * @param UpdateTestimonialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestimonialRequest $request)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error(trans('admin.Testimonial_not_found'));

            return redirect(route('Admin::testimonials.index'));
        }

        $testimonial = $this->testimonialRepository->update($request->all(), $id);
        HelpersFun::uploadFile($testimonial, $request->image, 'image', 'admin/testimonials');

        Flash::success(trans('admin.Testimonial_updated_successfully'));

        return redirect(route('Admin::testimonials.index'));
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            Flash::error(trans('admin.Testimonial_not_found'));

            return redirect(route('Admin::testimonials.index'));
        }

        $this->testimonialRepository->delete($id);

        Flash::success(trans('admin.Testimonial_deleted_successfully'));

        return redirect(route('Admin::testimonials.index'));
    }
}
