@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="{{ url()->previous() }}" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a>Edit User</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">User</li>
              <li class="breadcrumb-item active">Edit User</li>
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
              <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                  <!--full_name-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="full_name">Full Name</label>
                      <input id="full_name" value="{{ $user->full_name }}" type="text" class="form-control m-0"
                        placeholder="Full Name" name="full_name">
                      @error('full_name')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--username-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input id="username" value="{{ $user->username }}" type="text" class="form-control m-0"
                        placeholder="Username" name="username">
                      @error('username')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--email-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" value="{{ $user->email }}" type="email" class="form-control m-0"
                        placeholder="Email" name="email">
                      @error('email')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--phone-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input id="phone" value="{{ $user->phone }}" type="text" class="form-control m-0"
                        placeholder="Phone" name="phone">
                      @error('phone')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!--address-->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input id="address" value="{{ $user->address }}" type="text" class="form-control m-0"
                        placeholder="Address" name="address">
                      @error('address')
                        <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                </div>

                <!--role, status-->
                <div class="row clearfix mt-3">
                  <!--role-->
                  <div class="col-md-6 col-sm-12">
                    <label for="role">Role</label>
                    <select class="form-control show-tick m-0" id="role" name="role">
                      <option disabled selected>-- Role --</option>
                      <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                      <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                    @error('role')
                      <small class="font-weight-bold text-danger form-text">{{ $message }}</small>
                    @enderror
                  </div>
                  <!--status-->
                  <div class="col-md-6 col-sm-12">
                    <label for="status">Status</label>
                    <select class="form-control show-tick m-0" id="status" name="status">
                      <option disabled selected>-- Status --</option>
                      <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
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
