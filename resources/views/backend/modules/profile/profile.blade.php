@extends('backend.layouts.master')

@section('title', 'Profile')

@section('subtitle', 'Profile Update')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Update Profile</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($profile, ['method' => 'post', 'route' => 'profile.store']) !!}
                    {!! Form::label('phone', 'Phone', ['class'=>'w-100']) !!}
                    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                    {!! Form::label('address', 'Address', ['class'=>'w-100 mt-3']) !!}
                    {!! Form::text('address', null, ['class'=>'form-control']) !!}

                    <div class="row mt-3">
                        <div class="col-md-6">
                            {!! Form::label('province_code', 'Select Province', ['class'=>'w-100']) !!}
                            {!! Form::select('province_code', $provincies, null, ['id'=>'province_code', 'class'=>'form-select', 'placeholder'=>'Select Province']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="city_code">Select City</label>
                            <select name="city_code" id="city_code" class="form-select" disabled>
                                <option>Select City</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="district_code">Select District</label>
                            <select name="district_code" id="district_code" class="form-select" disabled>
                                <option>Select District</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="village_code">Select Village</label>
                            <select name="village_code" id="village_code" class="form-select" disabled>
                                <option>Select Village</option>
                            </select>
                        </div>
                    </div>

                    {!! Form::label('gender', 'Select Gender', ['class'=>'w-100 mt-3']) !!}
                    <div class="d-flex">
                        <div class="d-flex me-4">{!! Form::radio('gender', 'Male', false, ['class'=>'form-check me-1']) !!} Male</div>
                        <div class="d-flex">{!! Form::radio('gender', 'Female', false, ['class'=>'form-check me-1']) !!} Female</div>
                    </div>

                    {!! Form::button('Update Profile', ['type' => 'submit', 'class' => 'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Profile Photo</h4>
                </div>
                <div class="card-body">
                    <label for="">Upload Profile Photo</label>
                    <input type="file" class="form-control" name="" id="">
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    if ($profile) {
        $profile_exists = 1;
    } else {
        $profile_exists = 0;
    }
@endphp

@push('js')
    <script>
        const getCities = (province_code, selected = null) => {
            axios.get(`${window.location.origin}/get-cities/${province_code}`)
                .then(res => {
                    let cities = res.data;
                    let element = $('#city_code');
                    element.removeAttr('disabled');
                    element.empty();
                    element.append(`<option>Select City</option>`);
                    cities.map((city, index) => {
                        element.append(`<option value="${city.code}" ${selected == city.code ? 'selected' : ''}>${city.name}</option>`);
                    });
                }).catch(err => {

                });
        }

        const getDistricts = (city_code, selected = null) => {
            axios.get(`${window.location.origin}/get-districts/${city_code}`)
                .then(res => {
                    let districts = res.data;
                    let element = $('#district_code');
                    element.removeAttr('disabled');
                    element.empty();
                    element.append(`<option>Select District</option>`);
                    districts.map((district, index) => {
                        element.append(`<option value="${district.code}" ${selected == district.code ? 'selected' : ''}>${district.name}</option>`);
                    });
                }).catch(err => {

                });
        }

        const getVillages = (district_code, selected = null) => {
            axios.get(`${window.location.origin}/get-villages/${district_code}`)
                .then(res => {
                    let villages = res.data;
                    let element = $('#village_code');
                    element.removeAttr('disabled');
                    element.empty();
                    element.append(`<option>Select Village</option>`);
                    villages.map((village, index) => {
                        element.append(`<option value="${village.code}" ${selected == village.code ? 'selected' : ''}>${village.name}</option>`);
                    });
                }).catch(err => {

                });
        }

        $('#province_code').on('change', function () {
            getCities($(this).val());
        });

        $('#city_code').on('change', function () {
            getDistricts($(this).val());
        });

        $('#district_code').on('change', function () {
            getVillages($(this).val());
        });

        if ('{{ $profile_exists }}' == 1) {
            getCities('{{ $profile?->province_code }}', '{{ $profile?->city_code }}');
            getDistricts('{{ $profile?->city_code }}', '{{ $profile?->district_code }}');
            getVillages('{{ $profile?->district_code }}', '{{ $profile?->village_code }}');
        }
    </script>
@endpush
