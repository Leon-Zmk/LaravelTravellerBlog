@extends('master')

@section('title')
    Register : {{env("APP_NAME")}}
@endsection

@section("content")

    <div class="container">
        <div class="row mt-5 min-vh-100 justify-content-center">
            <div class="col-4">
                <div class="border rounded">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="my-4">
                                <img src="{{asset("logo/logo.png")}}" alt="">
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Your Name</label>
                                    <input type="text" name="name" required class="form-control">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" required class="form-control">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" required class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password"  name="password_confirmation" required class="form-control">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push("script")

@endpush