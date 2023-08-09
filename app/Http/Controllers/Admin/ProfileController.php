<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HelpersFun;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('admin.Profile'));
            $view->with('activeProfile',  $activeProfile = true);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $auth = Auth::user();
        return view('admin.profile.index', compact('auth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request){
        // $request->request->add(['username' => Str::slug($request->username)]); //add request
        $inputs = $request->except(['password', 'avatar', 'email']); // for don`t update password

        $user = Auth::user();
        $user->update($inputs);

        HelpersFun::uploadFile($user, $request->avatar, 'avatar', 'admin/admins');

        Flash::success(trans('admin.Profile_updated_successfully'));
        return redirect(route('Admin::profile.index'));
    }
}
