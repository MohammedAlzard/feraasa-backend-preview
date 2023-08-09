<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\HelpersFun;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Http\Controllers\AppBaseController;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Response;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        View::composer('*', function ($view) {
             $view->with('titlePage',  $titlePage = trans('admin.Settings'));
//             $view->with('activeSettings',  $activeSettings = true);
        });
    }

    /**
     * Display a listing of the Settings.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $titlePage = trans('admin.Settings');
        $activeSettings = true;

        $settings = Settings::first();

        return view('admin.settings.index', compact('titlePage', 'activeSettings'))
            ->with('settings', $settings);
    }

    /**
     * Update the specified Settings in storage.
     *
     * @param int $id
     * @param UpdateSettingsRequest $request
     *
     * @return Response
     */
    public function update(UpdateSettingsRequest $request)
    {
        $settings = Settings::first();

        if (empty($settings)) {
            Flash::error(trans('admin.Settings_not_found'));

            return redirect(route('Admin::settings.index'));
        }

        $settings->update($request->all());
        HelpersFun::uploadFile($settings, $request->site_favicon, 'site_favicon', 'admin/settings');
        HelpersFun::uploadFile($settings, $request->site_header_logo, 'site_header_logo', 'admin/settings');
        HelpersFun::uploadFile($settings, $request->site_footer_logo, 'site_footer_logo', 'admin/settings');

        Flash::success(trans('admin.Settings_updated_successfully'));

        return redirect(route('Admin::settings.index'));
    }

    // this function for Settings About Page
    public function about(){

        $titlePage = trans('admin.Settings_About_Page');
        $activeSettingsAboutPage = true;

        $settings = Settings::first();

        return view('admin.settings.about', compact('titlePage', 'activeSettingsAboutPage'))
            ->with('settings', $settings);
    }
    // this function for Update Settings About Page
    public function update_about(Request $request) {

        $request->validate([
            'about_section_image' => 'nullable|image|mimes:jpeg,jpg,png',
            'en.about_section_title' => 'required|string|max:250',
            'ar.about_section_title' => 'required|string|max:250',
            'en.about_section_short_description' => 'nullable|string|max:1000',
            'ar.about_section_short_description' => 'nullable|string|max:1000',
            'en.about_page_full_description' => 'required',
            'ar.about_page_full_description' => 'required',
        ]);

        $settings = Settings::first();

        if (empty($settings)) {
            Flash::error(trans('admin.Settings_not_found'));

            return redirect(route('Admin::settings.about'));
        }

        $settings->update($request->all());
        HelpersFun::uploadFile($settings, $request->about_section_image, 'about_section_image', 'admin/settings');

        Flash::success(trans('admin.Settings_updated_successfully'));

        return redirect(route('Admin::settings.about'));
    }

    // this function for Terms and conditions Page
    public function terms_and_conditions(){

        $titlePage = trans('admin.Terms_and_Conditions_Page');
        $activeTermsAndConditionsPage = true;

        $settings = Settings::first();

        return view('admin.settings.terms-and-conditions', compact('titlePage', 'activeTermsAndConditionsPage'))
            ->with('settings', $settings);
    }
    // this function for Update Settings Terms and conditions Page
    public function update_terms_and_conditions(Request $request) {

        $request->validate([
            'en.content_terms_and_conditions' => 'required',
            'ar.content_terms_and_conditions' => 'required',
        ]);

        $settings = Settings::first();

        if (empty($settings)) {
            Flash::error(trans('admin.Settings_not_found'));

            return redirect(route('Admin::settings.terms_and_conditions'));
        }
        $input = $request->only(['en.content_terms_and_conditions', 'ar.content_terms_and_conditions']);
        $settings->update($input);

        Flash::success(trans('admin.Settings_updated_successfully'));

        return redirect(route('Admin::settings.terms_and_conditions'));
    }


    // this function for Privacy & Policy Page
    public function privacy_and_policy(){

        $titlePage = trans('admin.Terms_and_Conditions_Page');
        $activePrivacyAndPolicyPage = true;

        $settings = Settings::first();

        return view('admin.settings.privacy-and-policy', compact('titlePage', 'activePrivacyAndPolicyPage'))
            ->with('settings', $settings);
    }
    // this function for Update Settings Privacy & Policy Page
    public function update_privacy_and_policy(Request $request) {

        $request->validate([
            'en.content_privacy_and_policy' => 'required',
            'ar.content_privacy_and_policy' => 'required',
        ]);

        $settings = Settings::first();

        if (empty($settings)) {
            Flash::error(trans('admin.Settings_not_found'));

            return redirect(route('Admin::settings.privacy_and_policy'));
        }
        $input = $request->only(['en.content_privacy_and_policy', 'ar.content_privacy_and_policy']);
        $settings->update($input);

        Flash::success(trans('admin.Settings_updated_successfully'));

        return redirect(route('Admin::settings.privacy_and_policy'));
    }

    // this function for Refund Policy Page
    public function refund_policy(){

        $titlePage = trans('admin.Refund_Policy_Page');
        $activeRefundPolicyPage = true;

        $settings = Settings::first();

        return view('admin.settings.refund-policy', compact('titlePage', 'activeRefundPolicyPage'))
            ->with('settings', $settings);
    }

    // this function for Update Settings Refund Policy Page
    public function update_refund_policy(Request $request) {

        $request->validate([
            'en.content_refund_policy' => 'required',
            'ar.content_refund_policy' => 'required',
        ]);

        $settings = Settings::first();

        if (empty($settings)) {
            Flash::error(trans('admin.Settings_not_found'));

            return redirect(route('Admin::settings.refund_policy'));
        }
        $input = $request->only(['en.content_refund_policy', 'ar.content_refund_policy']);
        $settings->update($input);

        Flash::success(trans('admin.Settings_updated_successfully'));

        return redirect(route('Admin::settings.refund_policy'));
    }

}
