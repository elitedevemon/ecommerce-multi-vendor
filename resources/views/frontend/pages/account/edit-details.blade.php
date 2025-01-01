@extends('frontend.layouts.master')
@section('title', 'Edit account details | ' . auth()->user()->full_name)
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>My Account</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('account.details', auth()->user()->username) }}">My Account</a>
            </li>
            <li class="breadcrumb-item active">Account Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- My Account Area -->
  <section class="my-account-area section_padding_50">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
          @include('frontend.pages.sidebar')
        </div>
        <div class="col-12 col-lg-9">
          <div class="my-account-content mb-50">
            <h5 class="mb-3">Account Details</h5>

            <form action="{{ route('account.update', auth()->user()->username) }}" method="post">
              @csrf
              @method('PUT')
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="row">
                <div class="col-12 col-lg-12">
                  <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name"
                      value="{{ auth()->user()->full_name }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" class="form-control" id="username" disabled
                      value="{{ auth()->user()->username }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="emailAddress">Email Address *</label>
                    <input type="email" class="form-control" id="emailAddress" disabled
                      value="{{ auth()->user()->email }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="currentPass">Current Password (Leave blank to leave unchanged)</label>
                    <input type="password" name="current_password" class="form-control" id="currentPass">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="newPass">New Password (Leave blank to leave unchanged)</label>
                    <input type="password" name="password" class="form-control" id="newPass">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="confirmPass">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirmPass">
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Account Area -->
@endsection
