<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Repositories\ReviewRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Response;

class ReviewController extends AppBaseController
{
    /** @var ReviewRepository $reviewRepository*/
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Reviews'));
            $view->with('activeReviews',  $activeReviews = true);
        });
    }

    /**
     * Display a listing of the Review.
     *
     * @param ReviewDataTable $reviewDataTable
     *
     * @return Response
     */
    public function index(ReviewDataTable $reviewDataTable)
    {
        return $reviewDataTable->render('admin.reviews.index');
    }

    /**
     * Show the form for creating a new Review.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created Review in storage.
     *
     * @param CreateReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateReviewRequest $request)
    {
        $input = $request->all();

        $review = $this->reviewRepository->create($input);

        Flash::success(trans('admin.Review_saved_successfully'));

        return redirect(route('Admin::reviews.index'));
    }

    /**
     * Display the specified Review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error(trans('admin.Review_not_found'));

            return redirect(route('Admin::reviews.index'));
        }

        return view('admin.reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified Review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error(trans('admin.Review_not_found'));

            return redirect(route('Admin::reviews.index'));
        }

        return view('admin.reviews.edit')->with('review', $review);
    }

    /**
     * Update the specified Review in storage.
     *
     * @param int $id
     * @param UpdateReviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReviewRequest $request)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error(trans('admin.Review_not_found'));

            return redirect(route('Admin::reviews.index'));
        }

        $review = $this->reviewRepository->update($request->all(), $id);

        Flash::success(trans('admin.Review_updated_successfully'));

        return redirect(route('Admin::reviews.index'));
    }

    /**
     * Remove the specified Review from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error(trans('admin.Review_not_found'));

            return redirect(route('Admin::reviews.index'));
        }

        $this->reviewRepository->delete($id);

        Flash::success(trans('admin.Review_deleted_successfully'));

        return redirect(route('Admin::reviews.index'));
    }
}
