<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Support\Facades\View;
use Response;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Users'));
             $view->with('activeUsers',  $activeUsers = true);
        });
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return redirect(route('Admin::users.index'));

        return view('admin.users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        return redirect(route('Admin::users.index'));
        $input = $request->all();

        $user = $this->userRepository->create($input);

        Flash::success(trans('admin.User_saved_successfully'));

        return redirect(route('Admin::users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('admin.User_not_found'));

            return redirect(route('Admin::users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('admin.User_not_found'));

            return redirect(route('Admin::users.index'));
        }

        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('admin.User_not_found'));

            return redirect(route('Admin::users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success(trans('admin.User_updated_successfully'));

        return redirect(route('Admin::users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return redirect(route('Admin::users.index'));
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('admin.User_not_found'));

            return redirect(route('Admin::users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(trans('admin.User_deleted_successfully'));

        return redirect(route('Admin::users.index'));
    }
}
