@extends('master')

@section("content")

    <div class="container">
        <div class="row justify-content-center">
             <div class="col-lg-8 m-4 col-xl-10   ">
                        <div class="post mt-5 mb-4">   
                                <div class="">
                                    <h4 class="text-center font-weight-bold">{{$post->title}}</h4>
                                    <br>
                                    <img src="{{asset("storage/cover/$post->cover")}}" class="cover-img w-100 rounded " alt="">
                                    <br>
                                    <p class="text-muted m-5 description">{{$post->description}}</p>
                                </div>
                                       

                                         @if(is_null($post->galleries))
                                            <div class="border rounded p-4">
                                                <div class="row">
                                                    @foreach($post->galleries as $gallery)
                                                        <div class="col-6 col-lg-4 col-xl-3 my-2">
                                                        <a class="venobox" data-gall="myGallery" href="{{asset("storage/gallery/$gallery->photo")}}"><img src="{{asset("storage/gallery/$gallery->photo")}}" style="object-fit:cover" class=" w-100 h-100 rounded" /></a>    
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                           @else  

                                                <div class="d-flex justify-content-center border p-3 rounded mb-5">
                                                    <h5 class="text-muted">There is No Galleries</h5>
                                                </div>
                                                

                                         @endif

                                        
                                        <div class="comment mt-5">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    @forelse ($post->comments as $comment)
                                                        
                                                    <div class=" border rounded   p-4 mb-5">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="">
                                                                <img src="{{asset("storage/profile/".$comment->user->photo)}}" class="user-img rounded-circle" alt="">
                                                                  {{$comment->user->name}} (<i class="fas fa-calendar-alt"></i>
                                                                  {{$comment->created_at->diffForHumans()}})
                                                                <br>
                                                            
                                                            </div>
                                                            @can("delete",$comment)

                                                                    <form action="{{route("comment.destroy",$comment->id)}}" method="POST">
                                                                        @csrf
                                                                        @method("delete")
                                                                        <button class="btn btn-sm p-3 btn-outline-danger">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    
                                                                    </form>
                                                            @endcan
                                                        </div>
                                                       <div class="mt-3">
                                                           <p>
                                                             {{$comment->message}}
                                                           </p>
                                                       </div>
                                                    </div>

                                                    @empty
                                                            <div class="d-flex justify-content-center border p-3 rounded mb-5">
                                                                <h5 class="text-muted">There is No Comments</h5>
                                                            </div>
                                                    @endforelse
                                                    
                                                  @auth
                                                        <div class="" id="create-comment">
                                                            <div class="text-center">
                                                                <h5 class="text-muted">Your Comment</h5>
                                                            </div>
                                                            <form action="{{route("comment.store")}}" class="text-center"  method="POST">
                                                                @csrf
                                                                <input type="text" name="post_id" value="{{$post->id}}" class="d-none">
                                                                <div class="form-group">
                                                                    <textarea name="message" required class=" border form-control custom-form-control @error('message') is-invalid @enderror " style="resize: none" id="" rows="10"></textarea>
                                                                </div>
                                                                @error('message')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            <button class="btn btn-sm p-3 btn-outline-info">
                                                                <i class="fas fa-pen-alt"></i>
                                                            </button>
                                                            
                                                            </form>
                                                       </div>

                                                  @endauth
                                                </div>
                                            </div>
                                        </div>
                                       <div class="border rounded p-4">
                                           <div class="d-flex align-items-center justify-content-between">
                                               <div class="">
                                                   <img src="{{asset("storage/profile/".$post->user->photo)}}" class="user-img rounded-circle" alt="">
                                                     {{$post->user->name}}
                                                   <br>
                                                   <i class="fas fa-calendar-alt"></i>
                                                   {{$post->created_at->format("d M Y")}}
                                               </div>
                                               <div class="">
                                                  @auth
                                                  @can("delete",$post)
                                                    <form action="{{route("post.destroy",$post->id)}}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method("delete")
                                                            <button class=" btn btn-sm btn-outline-danger p-3">
                                                                <i class="fas fa-trash-arrow-up"></i>
                                                            </button>
                                                    </form>
                                                    @endcan
                                                    @can("update",$post)
                                                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm p-3 btn-outline-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @endcan
                                                    @endauth
                                                   <a href="{{route("index")}}" class=" btn btn-sm p-3 btn-outline-primary">
                                                        <i class="fas fa-backward"></i>
                                                    </a>
                                               </div>
                                           </div>

                                       </div>
                        </div>
            </div>
        </div>
    </div>



@endsection

<div class="pt-5 bg-primary">

</div>

@push("script")

@endpush
