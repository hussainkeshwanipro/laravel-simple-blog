@extends('layouts.master')

@section('title')
BLog
@endsection

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
<!-- Ekko Lightbox -->
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('blog.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title"  value="{{ $data->title }}" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                </div>

                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <textarea class="textarea" name="desc"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data->desc }}</textarea>
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" accept="image/*" onchange="loadFile(event)"/>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                      </div>
                                    </div>
                                    <br>
                                    <img id="output" width="100px" height="100px"/>
                                  </div>

                            </div>
                            {{-- card body completed --}}
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>

                    </div>
                    {{-- card complete --}}

                </div>

                <div class="col-lg-4">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@section('js')
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>

<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
</script>
<!-- Ekko Lightbox -->

@endsection 