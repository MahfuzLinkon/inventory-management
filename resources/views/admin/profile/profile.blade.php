@extends('admin.layouts.master')

@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Profile</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card" >
                    <div class="card-header bg-primary">
                      <h5 class="h6 font-weight-semi-bold text-uppercase mb-0 float-left">Profile Information</h5>
                      <div class="position-relative ml-auto">
                      <a id="dropDownSettingsInvoker" class="unfold-invoker d-flex float-right" href="#" aria-controls="dropDownSettings" aria-haspopup="true" aria-expanded="false" data-unfold-target="#dropDownSettings" data-unfold-event="click" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                        <i class="gd-settings"></i>
                    </a>
                    <ul id="dropDownSettings" class="unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-3 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="dropDownSettingsInvoker" style="min-width: 150px; animation-duration: 300ms;">
                        <li class="unfold-item">
                            <a class="unfold-link media align-items-center text-nowrap" href="#">
                                <i class="gd-pencil unfold-item-icon mr-3"></i>
                                <span class="media-body">Edit</span>
                            </a>
                        </li>
                        <li class="unfold-item">
                            <a class="unfold-link media align-items-center text-nowrap" href="#">
                                <i class="gd-image unfold-item-icon mr-3"></i>
                                <span class="media-body">Update Image</span>
                            </a>
                        </li>
                        <li class="unfold-item">
                            <a class="unfold-link media align-items-center text-nowrap" href="#">
                                <i class="gd-lock unfold-item-icon mr-3"></i>
                                <span class="media-body">Change Password</span>
                            </a>
                        </li>
                        <li class="unfold-item">
                            <a class="unfold-link media align-items-center text-nowrap" href="#">
                                <i class="gd-close unfold-item-icon mr-3"></i>
                                <span class="media-body">Delete</span>
                            </a>
                        </li>
                    </ul>
                    </div>


                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-8 mt-4">
                                <h4>{{ $profile->name }}</h4>
                                <h5>
                                    @if ($profile->role == 1 )
                                        Admin
                                    @elseif ($profile->role == 2 )
                                        Manager
                                    @elseif ($profile->role == 3 )
                                        Salesman
                                    @endif
                                </h5>
                                <hr>
                                <div class="my-3">
                                    <h5 class="fw-bold">Contact Info:</h5>
                                </div>
                                <div>
                                    <h5>{{ $profile->email }}</h5>
                                    <h5>Phone</h5>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4 rounded">
                                <img src="{{ $profile->image == null ? asset('uploads/images/no-image.jpg') : asset($profile->image) }}" class="img-fluid" style="border-radius: 15px;" alt="">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
  


    </div>
@endsection