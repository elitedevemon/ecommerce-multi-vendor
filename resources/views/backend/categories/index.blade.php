@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a> Category</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">Category</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="header">
              <h2><strong>Category</strong> List ({{ count($categories) }})</h2>
              <ul class="header-dropdown">
                <a href="{{ route('category.create') }}" class="btn btn-primary"><i style="font-size: 13px; width:15px"
                    class="fa fa-plus"></i>Create
                  Category</a>
              </ul>
            </div>
            <div class="body">
              <div class="table-responsive">
                <table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Summary</th>
                      <th>Photo</th>
                      <th>Is Parent</th>
                      <th>Parent</th>
                      <th>Status</th>
                      <th style="width: 15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($categories as $category)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($category->title, 12) }}</td>
                        <td>{{ Str::limit($category->slug, 12) }}</td>
                        <td>{!! Str::limit($category->summary, 12) !!}</td>
                        <td><img height="50" width="100" src="{{ asset('storage/' . $category->photo) }}"
                            alt="{{ Str::limit($category->title, 8) }}"></td>
                        <td>
                          {{ $category->is_parent == true ? 'Yes' : 'No' }}
                        </td>
                        <td>
                          @if ($category->parent_id)
                            {{ Str::limit($category->parent->title, 10) }}
                          @endif
                        </td>
                        <td>
                          <input type="checkbox" name="status" value="{{ $category->id }}"
                            {{ $category->status == 'active' ? 'checked' : '' }} data-toggle="toggle" data-on="Active"
                            data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td>
                          <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary float-left"><i
                              class="icon-note"></i></a>
                          <form action="{{ route('category.destroy', $category->id) }}" method="post"
                            class="float-left ml-1">
                            @csrf
                            @method('DELETE')
                            <a href="" data-id="{{ $category->id }}" class="dltBtn btn btn-danger"><i
                                class="icon-trash"></i></a>
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
          url: "{{ route('category_status.update') }}",
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
