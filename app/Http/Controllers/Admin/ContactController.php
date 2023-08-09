<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateContactRequest;
use App\Http\Requests\Admin\UpdateContactRequest;
use App\Repositories\ContactRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Response;

class ContactController extends AppBaseController
{
    /** @var ContactRepository $contactRepository*/
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Contacts'));
            $view->with('activeContacts',  $activeContacts = true);
        });
    }

    /**
     * Display a listing of the Contact.
     *
     * @param ContactDataTable $contactDataTable
     *
     * @return Response
     */
    public function index(ContactDataTable $contactDataTable)
    {
        return $contactDataTable->render('admin.contacts.index');
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return redirect()->back();
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        return redirect()->back();
        $input = $request->all();

        $contact = $this->contactRepository->create($input);

        Flash::success(trans('admin.Contact_saved_successfully'));

        return redirect(route('Admin::contacts.index'));
    }

    /**
     * Display the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(trans('admin.Contact_not_found'));

            return redirect(route('Admin::contacts.index'));
        }
         $contact->update([
             'is_read' => true
         ]);

        return view('admin.contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return redirect()->back();
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(trans('admin.Contact_not_found'));

            return redirect(route('Admin::contacts.index'));
        }

        return view('admin.contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param int $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        return redirect()->back();
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(trans('admin.Contact_not_found'));

            return redirect(route('Admin::contacts.index'));
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        Flash::success(trans('admin.Contact_updated_successfully'));

        return redirect(route('Admin::contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(trans('admin.Contact_not_found'));

            return redirect(route('Admin::contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success(trans('admin.Contact_deleted_successfully'));

        return redirect(route('Admin::contacts.index'));
    }
}
