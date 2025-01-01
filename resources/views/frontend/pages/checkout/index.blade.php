@extends('frontend.layouts.master')
@section('title', 'Checkout')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>Checkout</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">Checkout</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Checkout Steps Area -->
  <div class="checkout_steps_area">
    <a class="active" href="{{ route('checkout.index') }}"><i class="icofont-check-circled"></i> Login</a>
    <a href="{{ route('checkout.auth.billing') }}"><i class="icofont-check-circled"></i> Billing</a>
    <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
    <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
    <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
  </div>

  <!-- Checkout Area -->
  <div class="checkout_area section_padding_100_50">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="checkout_details_area mb-50">
            <h5>Checkout as a Guest or Register</h5>
            <p>Register with us for future convenience:</p>

            <form action="{{ route('checkout.guest_or_register') }}" id="guestOrRegister" method="post">
              @csrf
              <div class="custom-control mb-2 custom-radio">
                <input type="radio" id="customRadio1" value="guest" name="option" class="custom-control-input">
                <label class="custom-control-label" for="customRadio1">Checkout as Guest</label>
              </div>
              <div class="custom-control mb-2 custom-radio">
                <input type="radio" id="customRadio2" value="register" name="option" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Register</label>
              </div>
            </form>

            <h5 class="mt-4">Register and save time!</h5>
            <p>Register with us for future convenience:</p>

            <p class="mb-1"><i class="fa-solid fa-circle-dot"></i> Fast and easy check out </p>
            <p class="mb-1"><i class="fa-solid fa-circle-dot"></i></i> Easy access to your order history and status</p>

            <a href="{{ route('checkout.guest_or_register') }}"
              onclick="event.preventDefault(); document.getElementById('guestOrRegister').submit()"
              class="btn btn-primary mt-4">Continue</a>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="checkout_details_area mb-50">
            <h5>Login</h5>
            <p>Already registered? Please log in below:</p>

            <form action="{{ route('checkout.auth.login') }}" method="post">
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
              @session('error')
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endsession
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                  placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted"><i class="icofont-lock"></i> We'll never share your
                  email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
              </div>
              <div class="form-group">
                <div class="form-check pl-0">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                    <label class="custom-control-label" for="customCheck1">Remember me for this computer.</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
              <a class="forget_password" href="#">Forget Password?</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Checkout Area End -->
@endsection
