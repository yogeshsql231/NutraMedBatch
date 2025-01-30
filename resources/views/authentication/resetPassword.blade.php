@extends('layouts.masterLayout')

@section('title','Register User')

@section('content')

<div class="section-header">
    <h1>Reset Your Password, {{$user->name}}!</h1>
</div>

<div class="container mt-5">
    <div class="row">



        <div class="card-body">
            <form method="POST" action="{{ route('reset.password') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name"
                            value="{{ $user->name}}" autofocus readonly>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group col-12 col-md-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Enter your email"
                            value="{{$user->email}}" readonly>
                        <div class="invalid-feedback"></div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="password" class="d-block">New Password</label>
                        <input id="password" type="password" class="form-control pwstrength"
                            data-indicator="pwindicator" name="password">
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <input id="password2" type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>


                <input type="hidden" name="userId" value="{{$user->id}}">

                <div class="row">
                    <div class="col-12 col-md-6 mx-auto text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Reset Password
                        </button>
                    </div>
                </div>

            </form>


        </div>
    </div>
</div>


@endsection
