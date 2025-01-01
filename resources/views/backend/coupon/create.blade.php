@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="{{ url()->previous() }}" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Add Coupon</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Coupon</li>
              <li class="breadcrumb-item active">Add Coupon</li>
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
              <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix">
                  <!--code-->
                  <div class="col-6">
                    <div class="form-group">
                      <label for="code">Coupon Code</label>
                      <input id="code" type="text" class="form-control m-0" placeholder="Coupon Code"
                        name="code">
                      @error('code')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--expiry-->
                  <div class="col-6">
                    <div class="form-group">
                      <label for="expiry_date">Coupon Expiry Date</label>
                      <input id="expiry_date" type="date" class="form-control m-0" placeholder="Coupon expiry_date"
                        name="expiry_date">
                      @error('expiry_date')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <!--stock, price, offer_price, discount, size-->
                <div class="row clearfix mt-3">
                  <!--value-->
                  <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                      <label for="value">Value</label>
                      <input id="value" type="number" class="form-control m-0" placeholder="Value" name="value">
                      @error('value')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--type-->
                  <div class="col-md-4 col-sm-12">
                    <label for="type">Type</label>
                    <select class="form-control show-tick m-0" id="type" name="type">
                      <option disabled selected>-- Type --</option>
                      <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                      <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                    </select>
                    @error('type')
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
                </div>
                <!--photo & submit-->
                <div class="row clearfix">
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
