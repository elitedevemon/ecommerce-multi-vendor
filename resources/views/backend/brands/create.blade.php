@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="{{ url()->previous() }}" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Add
              Brand</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Brand</li>
              <li class="breadcrumb-item active">Add Brand</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="body">
              <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix">
                  <!--title-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input id="title" type="text" class="form-control m-0" placeholder="Title" name="title">
                      @error('title')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--status-->
                  <div class="col-md-12">
                    <label for="status">Status</label>
                    <select class="form-control show-tick m-0" id="status" name="status">
                      <option disabled selected>-- Status --</option>
                      <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <!--photo and submit-->
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
@endsection
@section('scripts')
  <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#description').summernote({
        height: 100
      });
    });
  </script>
@endsection
