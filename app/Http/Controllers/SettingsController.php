<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Redirect;
use Carbon\Carbon;
use DB;

class SettingsController extends Controller
{
    public function create(Request $request) {
        $settings = Settings::where('is_active', '1')->first();

        if(isset($settings) && !empty($settings)) {
            $data = ['settings' => $settings];
        } else {
            $data = [];
        }
        return view('settings.form')->with($data);
    }

    public function submit(Request $request) {
        $user_id = Auth::id();
        $created_date = Carbon::now()->toDateTimeString();

        $sid = $request->sid;
        $name = $request->name;
        $address = $request->address;
        $city = $request->city;
        $pincode = $request->pincode;
        $state = $request->state;
        $phone = $request->phone;
        $email = $request->email;
        $gst = $request->gst;

        if(isset($sid) && !empty($sid)) {
            $update = Settings::find($sid);
            $update->name = strtoupper($name);
            $update->address = ucfirst($address);
            $update->city = ucfirst($city);
            $update->pincode = $pincode;
            $update->state = $state;
            $update->phone = $phone;
            $update->email = $email;
            $update->gst = strtoupper($gst);
            $update->save();

            
        } else {
            $insert = new Settings;
            $insert->name = $name;
            $insert->address = $address;
            $insert->city = ucfirst($city);
            $insert->pincode = $pincode;
            $insert->state = $state;
            $insert->phone = $phone;
            $insert->email = $email;
            $insert->gst = strtoupper($gst);
            $insert->created_date = $created_date;
            $insert->user_id = $user_id;
            $insert->save();
        }

        $settings = Settings::where('is_active', '1')->first();
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Settings updated successfully', 'settings' => $settings];

        return back()->with($data);
    }
}
