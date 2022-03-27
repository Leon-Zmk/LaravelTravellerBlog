@extends('master')
@section('title')
    Change Password : {{env('APP_NAME')}}
@endsection

@section('content')
    
    <div class="container">
        <div class="row min-vh-100 justify-content-center mt-5">
            <div class="col-lg-3 col-xl-5">
                <div class="text-center mt-5">
                    <img src="{{asset("storage/profile/".auth()->user()->photo)}}" id="profilePic" class="profile-img" alt="">
                    <br>
                    <br>
                    <p>{{auth()->user()->name}}</p>
                    <small class="text-muted">
                        <p>{{auth()->user()->email}}</p>
                    </small>
                </div>
                <form action="{{route("profile.upassword")}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="" class="text-muted">Current Password</label>
                        <input type="password" name="old_password" class=" p-4 form-control">
                        @error('old_password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="text-muted">New Password</label>
                        <input type="password"  class="p-4 form-control" name="password" >
                        @error('password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="text-muted">Confirm Password</label>
                        <input type="password"  class="p-4 form-control" name="confirm_password" >
                        @error('confirm_password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">
                            Change Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')

    

@endpush