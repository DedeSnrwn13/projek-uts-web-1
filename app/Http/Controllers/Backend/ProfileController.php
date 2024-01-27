<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

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
            'village_code' => 'required',
            'photo' => 'nullable|image'
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
}
