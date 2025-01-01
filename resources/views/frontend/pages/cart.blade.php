@extends('frontend.layouts.master')
@section('title', 'Cart')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>Cart</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">Cart</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Cart Area -->
  <div class="cart_area section_padding_50 clearfix">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-12">
          <div class="cart-table">
            <div class="table-responsive" id="cartTable">
              @include('frontend.pages.partials.cart-table')
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6">
          <div class="cart-apply-coupon mb-30">
            <h6>Have a Coupon?</h6>
            <p>Enter your coupon code here &amp; get awesome discounts!</p>
            <!-- Form -->
            <div class="coupon-form">
              <form action="#">
                <input type="text" name="coupon_code" class="form-control" placeholder="Enter Your Coupon Code">
                <button type="submit" id="coupon_btn" class="btn btn-primary">Apply Coupon</button>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-5" id="cartTotal">
          @include('frontend.pages.partials.cart-total')
        </div>
      </div>
    </div>
  </div>
  <!-- Cart Area End -->
@endsection
