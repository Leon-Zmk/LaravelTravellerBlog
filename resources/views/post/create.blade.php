@extends("master")

@section("title")
    Create Post
@endsection

@section("content")

<div class="container mt-5">
    <div class="row justify-content-center">
       <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="h3 text-black-50">
                Create New Post
            </div>
            <div class="h5 text-muted">
                <i class="fas fa-calendar-alt"></i>
                {{date("d M Y")}}
            </div>
        </div>
            <form action="{{route("post.store")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group w-100 rounded-pill">
                    <input type="text" name="title" class="form-control @error("title") is-invalid @enderror" placeholder="Your Title">
                </div>
                @error("title")
                        <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="" class="text-muted d-block">Cover Photo</label>
                    <img src="{{asset("cover_default/image-default.png")}}" id="cover" class="img-fluid rounded @error("cover") border border-danger @enderror" alt="">
                    <input type="file" id="fileInput" name="cover" class="form-control d-none">
                    @error("cover")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control @error("description") is-invalid @enderror" id=""  rows="8" placeholder="Share Your Experience"></textarea>
                </div>
                @error("description")
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="d-flex justify-content-center m-5">
                    <button class="btn btn-lg rounded-pill px-5 btn-primary">
                        <i class="fas fa-message"></i>
                        Send
                    </button>
                </div>
            </form>
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
    </script>
@endpush
