@extends('frontend.layouts.master')
@section('title', 'Account orders | ' . auth()->user()->full_name)
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
            <li class="breadcrumb-item active">Orders</li>
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
            <p>The following addresses will be used on the checkout page by default.</p>

            <div class="row">
              <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                <h6 class="mb-3">Billing Address</h6>
                <address>
                  {{ auth()->user()->full_name }} <br>
                  {{ $billing_address->country }}, {{ $billing_address->city }} <br>
                  {{ $billing_address->state }} <br>
                  {{ $billing_address->street_address }} <br>
                  {{ $billing_address->post_code }}
                </address>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#billingAddress">
                  Edit Address
                </button>
              </div>
              <div class="col-12 col-lg-6">
                <h6 class="mb-3">Shipping Address</h6>
                <address>
                  {{ auth()->user()->full_name }} <br>
                  {{ $shipping_address->country }}, {{ $shipping_address->city }} <br>
                  {{ $shipping_address->state }} <br>
                  {{ $shipping_address->street_address }} <br>
                  {{ $shipping_address->post_code }}
                </address>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#shippingAddress">
                  Edit Address
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Account Area -->

  <!-- Modal -->
  @include('frontend.pages.account.modal.billing-address')
  @include('frontend.pages.account.modal.shipping-address')
@endsection
