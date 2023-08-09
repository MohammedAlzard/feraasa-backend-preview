<?php

namespace App\Http\Controllers\User;

use App\Helpers\HelpersFun;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateSettingsRequest;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
        View::composer('*', function ($view) {
            $view->with('titlePage',  $titlePage = trans('user.Home'));
            $view->with('activeSettings',  $activeSettings = true);
        });
    }

    public function index() {
        $user = Auth::user();
        return view('user.settings', compact( 'user'));
    }

    public function update(Request $request) { // UpdateSettingsRequest

        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png',
            'username' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        $settings = Auth::user();

        if (empty($settings)) {
            Flash::error(trans('user.Settings_not_found'));

            return redirect(route('User::settings.index'));
        }

        $inputs = $request->except('avatar', 'password');
        $settings->update($inputs);
        HelpersFun::uploadFile($settings, $request->avatar, 'avatar', 'user/profile');

        Flash::success(trans('user.Settings_updated_successfully'));
        return redirect(route('User::settings.index'));
    }

}
