@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Edit Banner</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Banner</li>
              <li class="breadcrumb-item active">Edit Banner</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="body">
              <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                  <!--banner image-->
                  <div class="col-12 mx-auto mb-3">
                    <img src="{{ asset('storage/' . $banner->photo) }}" alt="{{ $banner->title }}" width="300"
                      height="300" class="img-fluid">
                  </div>
                  <!--title-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input id="title" type="text" value="{{ $banner->title }}" class="form-control m-0"
                        placeholder="Title" name="title">
                      @error('title')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--url-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="url">URL</label>
                      <input id="url" type="url" value="{{ $banner->url }}" class="form-control m-0"
                        placeholder="URL" name="url">
                      @error('url')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--description-->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea id="description" class="form-control" placeholder="Description" name="description">{{ $banner->description }}</textarea>
                      @error('description')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="condition">Condition</label>
                    <select class="form-control show-tick m-0" id="condition" name="condition">
                      <option disabled selected>-- Condition --</option>
                      <option value="banner" {{ $banner->condition == 'banner' ? 'selected' : '' }}>Banner</option>
                      <option value="promo" {{ $banner->condition == 'promo' ? 'selected' : '' }}>Promote</option>
                    </select>
                    @error('condition')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="status">Status</label>
                    <select class="form-control show-tick m-0" id="status" name="status">
                      <option disabled selected>-- Status --</option>
                      <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $banner->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
