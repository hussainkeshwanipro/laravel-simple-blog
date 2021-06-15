@extends('layouts.master')

@section('title')
BLog
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                <div class="col-sm-6">
                    <h1 class="m-0"><a href="{{ route('blog.create') }}" class="btn btn-dark float-right">Add New</a></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                    @endif
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                          </thead>
                          <tbody>
                              @foreach ($data as $item)
                              <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td> {{ strip_tags($item->desc) }}</td>
                                <td><img src="upload/{{ $item->image }}" alt="" width="100px" height="100px"></td>
                                <td><a href="{{ route('blog.edit', $item->id) }}" class="btn btn-success">Edit</a></td>
                                <td>
                                    <form action="{{ route('blog.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are You sure?')"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                              </tr>
                              @endforeach
                           
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
$('#example2').DataTable({
   
});

</script>

@endsection