@extends("master")

@section("title")
    Update Post : {{env('APP_NAME')}}
    
@endsection

@section("content")

<div class="container mt-5">
    <div class="row justify-content-center">
       <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="h3 text-black-50">
                Update Post
            </div>
            <div class="h5 text-muted">
                <i class="fas fa-calendar-alt"></i>
                {{date("d M Y")}}
            </div>
        </div>
            <form action="{{route("post.update",$post->id)}}" id="update" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group w-100 rounded-pill">
                    <input type="text" name="title" class="form-control @error("title") is-invalid @enderror" value="{{old("title",$post->title)}}" placeholder="Your Title">
                </div>
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="" class="text-muted d-block">Cover Photo</label>
                    <img src="{{asset("storage/cover/$post->cover")}}" id="cover" class="img-fluid rounded @error("cover") border border-danger @enderror" alt="">
                    <input type="file" id="fileInput" name="cover" class="form-control d-none">
                    @error('cover')
                    <span class="text-danger">{{$message}}</span>
                   @enderror
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control @error("description") is-invalid @enderror" id=""  rows="8" placeholder="Share Your Experience">{{old("description",$post->description)}}</textarea>
                </div>
                @error('description')
                <span class="text-danger">{{$message}}</span>
               @enderror   
            </form>

            <div class=" border rounded p-3">
                <div class="d-flex align-items-stretch pt-4 overflow-scroll">
                    <div class=" border rounded d-flex justify-content-center align-items-center " id="img-ui" style="width: 100px;height:150px">
                        <i class="fas fa-arrow-alt-circle-up" ></i>
                    </div>
                    <div class="imgs d-flex " id="img-container" style="height: 150px;width:150px;">
                        @if(isset($post->galleries))
                            @foreach ($post->galleries as $gallery)
                            <img src="{{asset("storage/gallery/$gallery->photo")}}" style="object-fit:cover;"  class=" mx-2 h-100 w-100 rounded" alt="">

                            <form action="{{route("gallery.destroy",$gallery->id)}}" class="d-inline" id="delForm"  method="POST">
                                @csrf
                                @method("delete")
                                <button class="btn border-0  ">
                                    <i class=" fas fa-xmark"></i>
                                </button>
                            </form>
                            @endforeach
                        @endif
                   </div>
                </div>
                <form action="{{route("gallery.store")}}"id="img-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="post_id"  value="{{$post->id}}"  class="d-none"> 
                    <div class="form-group">
                        <input type="file" name="galleries[]" id="img-input" multiple class="form-control d-none">
                    </div>
                    @error('galleries')
                    <span class="text-danger">{{$message}}</span>
                    @enderror  
                    @error('galleries.*')
                    <span class="text-danger">{{$message}}</span>
                    @enderror    
                   
                </form>
            </div>

            <div class="d-flex justify-content-center m-5">
                <button class="btn btn-primary" form="update">
                    Update
                </button>     
            </div>
          
       </div>
    </div>
</div>


@endsection

@push("script")
    <script>
        let cover=document.getElementById("cover");
        let inputFile=document.getElementById("fileInput");
        cover.addEventListener("click",function(){
            inputFile.click();
        })
        inputFile.addEventListener('change',function(){
            let file=inputFile.files[0]
            let reader=new FileReader();
            reader.readAsDataURL(file)
            reader.addEventListener("load",_=>{
               cover.src=reader.result;
            })
        })

        let uploadUi=document.getElementById("img-ui");
        let uploadForm=document.getElementById("img-form");
        let uploadInput=document.getElementById("img-input");

        uploadUi.addEventListener('click',_=>{
            uploadInput.click();
        })
        uploadInput.addEventListener('change',_=>{
            uploadForm.submit();
        })
    </script>
@endpush
