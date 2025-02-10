@extends('layouts.masterLayout')

@section('title','Profile')

@section('content')

<div class="section-header">
    <h1> Profile</h1>
</div>



<div class="section-body">
    <h2 class="section-title">Hi, {{$user->name}}!</h2>
    <p class="section-lead">
        Change information about yourself on this page.
    </p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header d-flex justify-content-center">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">

                </div>
                <div class="profile-widget-description">
                    {{-- <div class="profile-widget-name">
                        {{ $user->name }}
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> Web Developer
                        </div>
                    </div> --}}
                    <div class="row mt-3">
                        <div class="col-4">
                            <p class="font-weight-bold">Your Role:</p>
                            <p class="font-weight-bold">Your Permissions:</p>

                        </div>
                        <div class="col-8">

                            <p>
                                @if($user->getRoleNames()->isNotEmpty())
                                {{ implode(', ', $user->getRoleNames()->toArray()) }}
                                @else
                                <em>No roles assigned</em>
                                @endif
                            </p>


                            <p>
                                @if($user->getAllPermissions()->isNotEmpty())
                                @foreach($user->getAllPermissions() as $permission)
                                <span class="badge badge-success">{{ $permission->name }}</span>
                                @endforeach
                                @else
                                <em>No permissions assigned</em>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" action="{{route('profile')}}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" required="">
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{$user->email}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection