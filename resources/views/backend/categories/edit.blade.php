@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Edit Category</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="body">
              <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                  <!--title-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input id="title" type="text" value="{{ $category->title }}" class="form-control m-0"
                        placeholder="Title" name="title">
                      @error('title')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--summary-->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="summary">Summary</label>
                      <textarea id="summary" class="form-control" placeholder="summary" name="summary">{{ $category->summary }}</textarea>
                      @error('summary')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--is_parent-->
                  <div class="col-md-6 col-sm-12">
                    <label for="is_parent">Is Parent: </label> <br>
                    <input type="checkbox" id="is_parent" name="is_parent" value="1" data-toggle="toggle"
                      {{ $category->is_parent == '1' ? 'checked' : '' }} data-on="Parent" data-off="Child"
                      data-onstyle="success" data-offstyle="danger">
                  </div>

                  <div class="col-md-6 col-sm-12 {{ $category->is_parent == '1' ? 'd-none' : '' }} parent_id">
                    <label for="parent_id">Parent Category</label>
                    <select class="form-control show-tick m-0" id="parent_id" name="parent_id">
                      <option disabled selected>-- Parent Category --</option>
                      @foreach ($category_data as $data)
                        <option value="{{ $data->id }}" {{ $data->id == $category->parent_id ? 'selected' : '' }}>
                          {{ $data->title }}
                        </option>
                      @endforeach
                    </select>
                    @error('condition')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="col-md-12 mt-2">
                    <label for="status">Status</label>
                    <select class="form-control show-tick m-0" id="status" name="status">
                      <option disabled selected>-- Status --</option>
                      <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-12 my-3">
                    <input type="file" class="dropify" name="photo">
                    @error('photo')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('styles')
  <link href="{{ asset('backend/summernote/summernote.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
@endsection
@section('scripts')
  <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#summary').summernote({
        height: 100
      });
    });
  </script>
  <script>
    $('input[name=is_parent]').change(function(e) {
      e.preventDefault();
      var val = $(this).prop('checked');
      if (val === true) {
        $('.parent_id').addClass('d-none');
      } else {
        $('.parent_id').removeClass('d-none');

      }
    })
  </script>
@endsection
