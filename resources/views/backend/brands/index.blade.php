@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a> Brand</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="header">
              <h2><strong>Brand</strong> List ({{ count($brands) }})</h2>
              <ul class="header-dropdown">
                <a href="{{ route('brand.create') }}" class="btn btn-primary"><i style="font-size: 13px; width:15px"
                    class="fa fa-plus"></i>Create
                  Brand</a>
              </ul>
            </div>
            <div class="body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Photo</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($brands as $brand)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($brand->title, 13) }}</td>
                        <td>{{ Str::limit($brand->slug, 13) }}</td>
                        <td><img height="50" width="150" src="{{ asset('storage/' . $brand->photo) }}"
                            alt="{{ Str::limit($brand->title, 8) }}"></td>
                        <td>
                          <input type="checkbox" name="status" value="{{ $brand->id }}"
                            {{ $brand->status == 'active' ? 'checked' : '' }} data-toggle="toggle" data-on="Active"
                            data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td>
                          <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-primary float-left">Edit</a>
                          <form action="{{ route('brand.destroy', $brand->id) }}" method="post" class="float-left ml-1">
                            @csrf
                            @method('DELETE')
                            <a href="" data-id="{{ $brand->id }}" class="dltBtn btn btn-danger">Delete</a>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8">
                          <strong>No data found</strong>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('styles')
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
@endsection

@section('scripts')
  <script script script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      e.preventDefault();
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    })
  </script>
  <script>
    $('input[name=status]').change(function() {
      var mode = $(this).prop('checked');
      var id = $(this).val();
      // alert(id);
      if (confirm("Are you sure !!")) {
        $.ajax({
          type: "POST",
          url: "{{ route('brand_status.update') }}",
          data: {
            _token: "{{ csrf_token() }}",
            mode: mode,
            id: id
          },
          success: function(response) {
            if (response.status) {
              alert(response.message);
            } else {
              alert("Please try again");
            }
          }
        });
      }
    })
  </script>
@endsection