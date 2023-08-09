<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HelpersFun;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Repositories\ServiceRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class ServiceController extends AppBaseController
{
    /** @var ServiceRepository $serviceRepository*/
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Services'));
            $view->with('activeServices',  $activeServices = true);
        });
    }

    /**
     * Display a listing of the Service.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $services = $this->serviceRepository->all();

        return view('admin.services.index')
            ->with('services', $services);
    }

    /**
     * Show the form for creating a new Service.
     *
     * @return Response
     */
    public function create()
    {
        return redirect()->back();
        return view('admin.services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param CreateServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceRequest $request)
    {
        return redirect()->back();
        $input = $request->all();

        $service = $this->serviceRepository->create($input);
        HelpersFun::uploadFile($service, $request->icon, 'icon', 'admin/services');

        Flash::success(trans('admin.Service_saved_successfully'));

        return redirect(route('Admin::services.index'));
    }

    /**
     * Display the specified Service.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(trans('admin.Service_not_found'));

            return redirect(route('Admin::services.index'));
        }

        return view('admin.services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(trans('admin.Service_not_found'));

            return redirect(route('Admin::services.index'));
        }

        return view('admin.services.edit')->with('service', $service);
    }

    /**
     * Update the specified Service in storage.
     *
     * @param int $id
     * @param UpdateServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(trans('admin.Service_not_found'));

            return redirect(route('Admin::services.index'));
        }

        $service = $this->serviceRepository->update($request->all(), $id);
        HelpersFun::uploadFile($service, $request->icon, 'icon', 'admin/services');

        Flash::success(trans('admin.Service_updated_successfully'));

        return redirect(route('Admin::services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        return redirect()->back();
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(trans('admin.Service_not_found'));

            return redirect(route('Admin::services.index'));
        }

        $this->serviceRepository->delete($id);

        Flash::success(trans('admin.Service_deleted_successfully'));

        return redirect(route('Admin::services.index'));
    }
}
