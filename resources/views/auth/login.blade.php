@extends('master')

@section("title")

    Login : {{env("APP_NAME")}}

@endsection

@section("content")

    <div class="container" >
            <div class="row min-vh-100 justify-content-center mt-5" >
                <div class="col-lg-4">
                    <div class="border rounded">
                        <div class="card-header  font-weight-bold">
                            Login
                        </div>
                       <div class="card-body ">
                        <div class="my-4">
                            <img src="{{asset("logo/logo.png")}}" alt="">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="" class="text-muted">Email</label>
                                <input type="text"  name="email" required class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                <span class="text-danger " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="text-muted">Password</label>
                                <input type="password"  name="password" required class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button class="btn btn-primary px-4">Login</button>
                            </div>
                        </form>
                       </div>
                    </div>
                </div>
            </div>
    </div>

@endsection

@push("script")


@endpush