<?php

namespace App\Helpers;

use App\Models\Images;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HelpersFun
{
    public static function isTrue($value)
    {
        if ($value) {
            return trans('admin.Yes');
        }
        return trans('admin.No');
    }

    public static function settings()
    {
        if (empty(Session::get('locale'))) {
            Session::put('locale', 'en');
        }
        App::setLocale(Session::get('locale'));

        $settings = Settings::first();
        return $settings;
    }

    // this function for Upload File
    public static function uploadFile($modal, $file, $attribute, $folder_name)
    {
        if (!empty($file)) {
            $file_name = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $folder_name . '/'), $file_name);

            $file_name = '/uploads/' . $folder_name . '/' . $file_name;
            $modal->{$attribute} = $file_name;
            $modal->save();
        }
    }


// this function for Upload Files
    public static function uploadFiles($modal, $files, $folder_name, $attribute = null, $put_session = false)
    {
        if (!empty($files[0])) {
            foreach ($files as $index=>$file) {
                if (!empty($file)) {

                    $file_name = time() . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/' . $folder_name . '/'), $file_name);
                    $file_name = '/uploads/' . $folder_name . '/' . $file_name;

                    $image = new Images();
                    $image->parent_id = $modal->id;
                    $image->name = $file_name;
                    $image->model = get_class($modal);
                    $image->save();

                    if ($put_session){
                        $attribute2 = $attribute.strval($index+1);
                        Session::put('order_service_fields.'.$attribute2, $file_name);
                    }
                }
            }
        }
    } // End Upload Files Function


    // this function for Upload File General
    public static function uploadFileGeneral($file, $attribute, $folder_name)
    {
        if (!empty($file)) {
            $file_name = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $folder_name . '/'), $file_name);

            $file_name = '/uploads/' . $folder_name . '/' . $file_name;
        }
    }


    // Number of Clients by year and month
    public static function numberOfUsersByYearAndMonth($year, $month)
    {
        try {
            $users = User::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        } catch (\Exception $exception) {
            $users = 0;
        }
        return $users;
    }

    // get Sellers Activated And Not Activated Count
    public static function getUsersActivatedAndNotActivatedCount($value)
    {
        try {
            $activated = User::where('is_active', $value)->count();
        } catch (\Exception $exception) {
            $activated = 0;
        }
        return $activated;
    }


    public static function checkSubscription($service_id) {
        if (Auth::user()) {
            $user = Auth::user();

            $service = Service::find($service_id);
            if (empty($service)) {
                return false;
            }
            $subscribed = Subscription::where('user_id', Auth::user()->id)->active()->where(['service_id'=>$service_id, 'user_id'=>$user->id])->where('trial_ends_at', '>=', Carbon::now())->first();

            if (!empty($subscribed) && $user->subscribed($service->slug)) {
                return true;
            }
        }
        return false;
    }

}
