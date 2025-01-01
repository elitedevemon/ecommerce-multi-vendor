@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="{{ url()->previous() }}" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Add Product</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active">Add Product</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="body">
              <!--error bag-->
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                  <!--summary-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="summary">Summary</label>
                      <textarea name="summary" id="summary" class="form-control" placeholder="Summary" rows="5"></textarea>
                      @error('summary')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--description-->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea id="description" class="form-control" placeholder="Description" name="description"></textarea>
                      @error('description')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--brands-->
                  <div class="col-md-4 col-sm-12">
                    <label for="brand">Brand</label>
                    <select class="form-control show-tick m-0" id="brand" name="brand_id">
                      <option disabled selected>-- Brand --</option>
                      @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                      @endforeach
                    </select>
                    @error('brand_id')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <!--parent categories-->
                  <div class="col-md-4 col-sm-12">
                    <label for="category">Parent Category</label>
                    <select class="form-control show-tick m-0" id="category" name="category_id">
                      <option disabled selected>-- Category --</option>
                      @foreach ($categories as $category)
                        @if ($category->is_parent == '1')
                          <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('category_id')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <!--child categories-->
                  <div class="col-md-4 col-sm-12">
                    <label for="child_category">Child Category</label>
                    <select class="form-control show-tick m-0" id="child_category" name="child_category_id">
                      <option disabled selected>-- Category --</option>
                      @foreach ($categories as $category)
                        @if ($category->is_parent == '0')
                          <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('child_category_id')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <!--stock, price, offer_price, discount, size-->
                <div class="row clearfix mt-3">
                  <!--stock-->
                  <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                      <label for="stock">Stock</label>
                      <input id="stock" type="number" class="form-control m-0" placeholder="Stock" name="stock">
                      @error('stock')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--price-->
                  <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input id="price" type="number" class="form-control m-0" placeholder="Price" name="price">
                      @error('price')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--offer price-->
                  <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                      <label for="offer_price">Offer Price</label>
                      <input id="offer_price" type="number" class="form-control m-0" placeholder="Offer Price"
                        name="offer_price">
                      @error('offer_price')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--discount-->
                  <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                      <label for="discount">Discount</label>
                      <input id="discount" type="number" class="form-control m-0" placeholder="Discount"
                        name="discount">
                      @error('discount')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--size-->
                  <div class="col-md-4 col-sm-12">
                    <label for="size">Size</label>
                    <select class="form-control show-tick m-0" id="size" name="size">
                      <option disabled selected>-- Size --</option>
                      <option value="s" {{ old('size') == 's' ? 'selected' : '' }}>Small</option>
                      <option value="m" {{ old('size') == 'm' ? 'selected' : '' }}>Medium</option>
                      <option value="l" {{ old('size') == 'l' ? 'selected' : '' }}>Large</option>
                      <option value="xl" {{ old('size') == 'xl' ? 'selected' : '' }}>Extra Large</option>
                    </select>
                    @error('size')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!--condition, status, vendor_id-->
                <div class="row clearfix mt-3">
                  <!--condition-->
                  <div class="col-md-4 col-sm-12">
                    <label for="condition">Condition</label>
                    <select class="form-control show-tick m-0" id="condition" name="condition">
                      <option disabled selected>-- Condition --</option>
                      <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                      <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>Popular</option>
                      <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>Winter</option>
                    </select>
                    @error('condition')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <!--status-->
                  <div class="col-md-4 col-sm-12">
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
                  <!--vendor-->
                  <div class="col-md-4 col-sm-12">
                    <label for="vendor">Vendor</label>
                    <select class="form-control show-tick m-0" id="vendor" name="vendor_id">
                      <option disabled selected>-- Vendor --</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                      @endforeach
                    </select>
                    @error('vendor_id')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <!--photo & submit-->
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
