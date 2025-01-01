@extends('frontend.layouts.master')
@section('title', 'Login | Register your account')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>Login &amp; Register</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Login &amp; Register</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Login Area -->
  <div class="bigshop_reg_log_area section_padding_50">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="login_form mb-50">
            <h5 class="mb-3">Login</h5>

            <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control" name="email" value="admin@gmail.com" id="username"
                  placeholder="Email or Username">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" value="1234" id="password"
                  placeholder="Password">
              </div>
              <div class="form-check">
                <div class="custom-control custom-checkbox mb-3 pl-1">
                  <input type="checkbox" checked class="custom-control-input" id="customChe">
                  <label class="custom-control-label" for="customChe">Remember me for this computer</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </form>
            <!-- Forget Password -->
            <div class="forget_pass mt-15">
              <a href="#">Forget Password?</a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="login_form mb-50">
            <h5 class="mb-3">Register</h5>

            <form action="{{ route('register') }}" method="post">
              @csrf
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="form-group">
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" id="password"
                  placeholder="Re-type Password">
              </div>
              <!--photo and submit-->
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Area End -->
@endsection

@section('scripts')
  <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/pages/forms/dropify.js') }}"></script>
@endsection
