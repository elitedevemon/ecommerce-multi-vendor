@extends('frontend.layouts.master')
@section('title', 'Checkout Guest Billing')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>Guest Checkout</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">Checkout</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Checkout Step Area -->
  <div class="checkout_steps_area">
    <a class="complated" href="{{ route('checkout.index') }}">
      <i class="icofont-check-circled"></i> Login
    </a>
    <a class="active" href="{{ route('checkout.guest.index', session()->get('guest_id')) }}">
      <i class="icofont-check-circled"></i> Billing
    </a>
    <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
    <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
    <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
  </div>

  <!-- Checkout Area -->
  <div class="checkout_area section_padding_100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="checkout_details_area clearfix">
            <h5 class="mb-4">Billing Details</h5>
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('checkout.guest.order.address') }}" method="post" id="guestOrderAddressForm">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" placeholder="Full Name" name="b_recipient"
                    value="{{ old('b_recipient') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email_address">Email Address</label>
                  <input type="email" class="form-control" id="email_address" name="b_email" placeholder="Email Address"
                    value="{{ old('b_email') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="b_phone" placeholder="Phone Number"
                    value="{{ old('b_phone') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="b_country" placeholder="Country"
                    value="{{ old('b_country') }}">
                </div>
                <div class="col-md-12 mb-3">
                  <label for="street_address">Street address</label>
                  <input type="text" class="form-control" id="street_address" placeholder="Street Address"
                    name="b_street_address" value="{{ old('b_street_address') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="apartment_suite">Apartment/Suite/Unit</label>
                  <input type="text" class="form-control" id="apartment_suite" placeholder="Apartment, suite, unit etc"
                    name="b_apartment" value="{{ old('b_apartment') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="city">Town/City</label>
                  <input type="text" class="form-control" id="city" placeholder="Town/City" name="b_city"
                    value="{{ old('b_city') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" placeholder="State" name="b_state"
                    value="{{ old('b_state') }}">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="postcode">Postcode/Zip</label>
                  <input type="text" class="form-control" id="postcode" placeholder="Postcode / Zip"
                    name="b_post_code" value="{{ old('b_post_code') }}">
                </div>
                <div class="col-md-12">
                  <label for="order-notes">Order Notes</label>
                  <textarea class="form-control" id="order-notes" cols="30" rows="10"
                    placeholder="Notes about your order, e.g. special notes for delivery." name="b_notes">{{ old('b_notes') }}</textarea>
                </div>
              </div>
              <!-- Different Shipping Address -->
              <div class="ship-different-title mt-50 mb-3" id="ship-different-address">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="add_different_shipping">
                  <label class="custom-control-label" for="customCheck1">Ship to a different address?</label>
                </div>
              </div>
              <div class="different-address d-none" id="shippingAddress">
                <div class="row shipping_input_field">
                  <div class="col-md-6 mb-3">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" placeholder="Full Name"
                      name="s_recipient" value="{{ old('s_recipient') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email_address">Email Address</label>
                    <input type="email" class="form-control" id="email_address" name="s_email"
                      placeholder="Email Address" value="{{ old('s_email') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="s_phone"
                      placeholder="Phone Number" value="{{ old('s_phone') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="s_country" placeholder="Country"
                      value="{{ old('s_country') }}">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="street_address">Street address</label>
                    <input type="text" class="form-control" id="street_address" placeholder="Street Address"
                      name="s_street_address" value="{{ old('s_street_address') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="apartment_suite">Apartment/Suite/Unit</label>
                    <input type="text" class="form-control" id="apartment_suite"
                      placeholder="Apartment, suite, unit etc" name="s_apartment" value="{{ old('s_apartment') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="city">Town/City</label>
                    <input type="text" class="form-control" id="city" placeholder="Town/City" name="s_city"
                      value="{{ old('s_city') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" placeholder="State" name="s_state"
                      value="{{ old('s_state') }}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="postcode">Postcode/Zip</label>
                    <input type="text" class="form-control" id="postcode" placeholder="Postcode / Zip"
                      name="s_post_code" value="{{ old('s_post_code') }}">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="delivery-address">Delivery Address</label>
                    <textarea class="form-control" id="delivery-address" cols="30" rows="10"
                      placeholder="Add you specific delivery address" name="s_delivery_address">{{ old('s_delivery_address') }}</textarea>
                  </div>
                  <div class="col-md-12">
                    <label for="order-notes">Order Notes</label>
                    <textarea class="form-control" id="order-notes" cols="30" rows="10"
                      placeholder="Notes about your order, e.g. special notes for delivery." name="s_notes">{{ old('s_notes') }}</textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12">
          <div class="checkout_pagination d-flex justify-content-end mt-50">
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
            <a href="javascript:void(0)" onclick="document.getElementById('guestOrderAddressForm').submit()"
              class="btn btn-primary mt-2 ml-2">Continue</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Checkout Area -->
@endsection

@section('scripts')
  <script>
    $('#ship-different-address input[type="checkbox"]').click(function() {
      var checked = $(this).prop('checked');
      if (checked) {
        $('#shippingAddress').removeClass('d-none');
      } else {
        $('#shippingAddress').addClass('d-none');
      }
    });
  </script>
@endsection
