@extends('master')
@section('title')
    Edit Profile : {{env('APP_NAME')}}
@endsection

@section('content')
    
    <div class="container">
        <div class="row min-vh-100 justify-content-center mt-5">
            <div class="col-lg-3 col-xl-5">
                <div class="text-center mt-5">
                    <img src="{{asset("storage/profile/".auth()->user()->photo)}}" id="profilePic" class="profile-img" alt="">
                    <br>
                    <button class="btn btn-primary" id="profilePicChanger" style="margin-top: -25px">
                        <i class="fas fa-pencil"></i>
                    </button>
                    <br>
                    <br>
                    <p>{{auth()->user()->name}}</p>
                    <small class="text-muted">
                        <p>{{auth()->user()->email}}</p>
                    </small>
                </div>
                <form action="{{route("profile.update")}}" id="profileForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <input type="file" name="photo" id="profilePicInput" class="d-none" accept="image/jpeg,image/png">
                    <div class="form-group">
                        <label for="" class="text-muted">Name</label>
                        <input type="text" name="name" class=" p-4 form-control " value="{{auth()->user()->name}}">
                        @error("name")
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="text-muted">Email</label>
                        <input type="email" disabled class="p-4 form-control" name="email" value="{{auth()->user()->email}}">
                        @error('email')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')

    <script>
        let profilePic=document.getElementById("profilePic");
        let profilePicChanger=document.getElementById("profilePicChanger");
        let profilePicInput=document.getElementById("profilePicInput");
        let profileForm=document.getElementById("profileForm");
        profilePicChanger.addEventListener("click",_=> profilePicInput.click());

        profilePicInput.addEventListener("change",function(){
            let file=this.files[0];
            let reader=new FileReader();
            reader.addEventListener("load",function(){
                profilePic.src=reader.result;
            })
            reader.readAsDataURL(file);
        })
    </script>

@endpush