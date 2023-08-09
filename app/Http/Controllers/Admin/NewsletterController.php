<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NewsletterDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateNewsletterRequest;
use App\Http\Requests\Admin\UpdateNewsletterRequest;
use App\Repositories\NewsletterRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Response;

class NewsletterController extends AppBaseController
{
    /** @var NewsletterRepository $newsletterRepository*/
    private $newsletterRepository;

    public function __construct(NewsletterRepository $newsletterRepo)
    {
        $this->newsletterRepository = $newsletterRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Newsletters'));
            $view->with('activeNewsletters',  $activeNewsletters = true);
        });
    }

    /**
     * Display a listing of the Newsletter.
     *
     * @param NewsletterDataTable $newsletterDataTable
     *
     * @return Response
     */
    public function index(NewsletterDataTable $newsletterDataTable)
    {
        return $newsletterDataTable->render('admin.newsletters.index');
    }

    /**
     * Show the form for creating a new Newsletter.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.newsletters.create');
    }

    /**
     * Store a newly created Newsletter in storage.
     *
     * @param CreateNewsletterRequest $request
     *
     * @return Response
     */
    public function store(CreateNewsletterRequest $request)
    {
        $input = $request->all();

        $newsletter = $this->newsletterRepository->create($input);

        Flash::success(trans('admin.Newsletter_saved_successfully'));

        return redirect(route('Admin::newsletters.index'));
    }

    /**
     * Display the specified Newsletter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $newsletter = $this->newsletterRepository->find($id);

        if (empty($newsletter)) {
            Flash::error(trans('admin.Newsletter_not_found'));

            return redirect(route('Admin::newsletters.index'));
        }

        return view('admin.newsletters.show')->with('newsletter', $newsletter);
    }

    /**
     * Show the form for editing the specified Newsletter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $newsletter = $this->newsletterRepository->find($id);

        if (empty($newsletter)) {
            Flash::error(trans('admin.Newsletter_not_found'));

            return redirect(route('Admin::newsletters.index'));
        }

        return view('admin.newsletters.edit')->with('newsletter', $newsletter);
    }

    /**
     * Update the specified Newsletter in storage.
     *
     * @param int $id
     * @param UpdateNewsletterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsletterRequest $request)
    {
        $newsletter = $this->newsletterRepository->find($id);

        if (empty($newsletter)) {
            Flash::error(trans('admin.Newsletter_not_found'));

            return redirect(route('Admin::newsletters.index'));
        }

        $newsletter = $this->newsletterRepository->update($request->all(), $id);

        Flash::success(trans('admin.Newsletter_updated_successfully'));

        return redirect(route('Admin::newsletters.index'));
    }

    /**
     * Remove the specified Newsletter from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $newsletter = $this->newsletterRepository->find($id);

        if (empty($newsletter)) {
            Flash::error(trans('admin.Newsletter_not_found'));

            return redirect(route('Admin::newsletters.index'));
        }

        $this->newsletterRepository->delete($id);

        Flash::success(trans('admin.Newsletter_deleted_successfully'));

        return redirect(route('Admin::newsletters.index'));
    }
}
