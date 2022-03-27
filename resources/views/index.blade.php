@extends('master')

@section("content")

    <div class="container">
        <div class="row justify-content-center min-vh-100">
             <div class="col-lg-8 col-xl-10   ">
                    @auth
                        <div class="welcome d-flex p-4 border rounded shadow-sm justify-content-between align-items-center">
                            <div class="">
                                <p class="h3 text-muted">
                                    Welcome
                                </p>
                                <p class="h3 font-weight-bold">
                                        {{auth()->user()->name}}
                                </p>
                            </div>
                            <a href="{{route("post.create")}}" class="btn btn-lg btn-primary rounded-pill px-4">Create Post</a>
                        </div>
                   @endauth
                    <div class="posts">
                        @forelse($posts as $post)
                        <div class="post mt-5 mb-4">
                            <div class="row">
                                <div class="d-flex">
                                   <div class="col-lg-4 mr-5">
                                       <img src="{{asset("storage/cover/$post->cover")}}" class="cover-img img-fluid rounded" alt="">
                                   </div>
                                   <div class="col-lg-8">
                                       <div class="d-flex flex-column justify-content-between p-4" style="height: 350px">
                                           <div class="">
                                               <h1 class=" font-weight-bold">{{$post->title}}</h1>
                                               <p class="text-muted description">{{$post->excerpt}}</p>
                                           </div>
                                           <div class="d-flex justify-content-between align-items-center">
                                               <div class="">
                                                   <img src="{{asset("storage/profile/".$post->user->photo)}}" class="user-img rounded-circle" alt="">
                                                     {{$post->user->name}}
                                                   <br>
                                                   <i class="fas fa-calendar-alt"></i>
                                                   {{$post->created_at->format("d M Y")}}
                                               </div>
                                               <div class="">
                                                   <a href="{{route("post.detail",$post->slug)}}" class=" btn btn-outline-primary">See More</a>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            </div>
                           </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$posts->links()}}
                    </div>
            </div>
        </div>
    </div>



@endsection

<div class="pt-5 bg-primary">

</div>

@push("script")

@endpush
