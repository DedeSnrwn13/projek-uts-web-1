@extends('backend.auth.layouts.master')

@section('title', 'Reset Password')

@section('content')
    {!! Form::open(['method' => 'post', 'route' => 'password.email']) !!}
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => $errors->has('email') ? 'is-invalid form-control form-control-sm' : 'form-control form-control-sm']) !!}
    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="d-grid">
        {!! Form::button('Reset Password', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-2']) !!}
    </div>
    {!! Form::close() !!}

    <p class="mt-3">Already Registered? <a href="{{ route('login') }}">Login Here</a></p>
    <p>Not Registered? <a href="{{ route('register') }}">Register Here</a></p>
@endsection
