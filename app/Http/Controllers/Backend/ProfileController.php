<?php

namespace App\Http\Controllers\Backend;

use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\PhotoUploadController;

class ProfileController extends Controller
{

    public function index()
    {
        $provincies = Province::pluck('name', 'code');
        $profile = Profile::where('user_id', Auth::id())->first();

        return view('backend.modules.profile.profile', compact('provincies', 'profile'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'province_code' => 'required',
            'city_code' => 'required',
            'district_code' => 'required',
            'village_code' => 'required'
        ]);

        $profile_data = $request->all();
        $profile_data['user_id'] = Auth::id();

        $existing_profile = Profile::where('user_id', Auth::id())->first();

        if ($existing_profile) {
            $existing_profile->update($profile_data);
        } else {
            Profile::create($profile_data);
        }

        session()->flash('cls', 'success');
        session()->flash('msg', 'Profile Created Successfully');

        return redirect()->back();
    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request, Profile $profile)
    {

    }

    public function destroy(Profile $profile)
    {

    }

    public function getCity(int $province_code)
    {
        $cities = City::select('code', 'name')->where('province_code', $province_code)->get();

        return response()->json($cities);
    }

    public function getDistrict(int $city_code)
    {
        $districts = District::select('name', 'code')->where('city_code', $city_code)->get();

        return response()->json($districts);
    }

    public function getVillage(int $district_code)
    {
        $villages = Village::select('name', 'code')->where('district_code', $district_code)->get();

        return response()->json($villages);
    }

    public function uploadPhoto(Request $request)
    {
        $file = $request->input('photo');
        $name = Str::slug(Auth::user()->name . Carbon::now());
        $height = 200;
        $width = 200;
        $path = 'images/user/';

        $profile = Profile::where('user_id', Auth::id())->first();
        if ($profile?->photo) {
            (new PhotoUploadController())->imageUnlink($path, $profile->photo);
        }

        $image_name = (new PhotoUploadController())->imageUpload($name, $height, $width, $path, $file);

        $profile_data['photo'] = $image_name;

        if ($profile) {
            $profile->update($profile_data);

            return response()->json([
                'msg' => 'Profile photo updated successfully',
                'cls' => 'success',
                'photo' => url($path . $profile->photo)
            ]);
        }

        return response()->json([
            'msg' => 'Please upload a photo first',
            'cls' => 'warning',
        ]);
    }
}
