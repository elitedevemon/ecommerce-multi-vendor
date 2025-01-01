@extends('frontend.layouts.master')
@section('title', 'Account details | ' . auth()->user()->full_name)
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>My Account</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">My Account</li>
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
            <p>Hello <strong>{{ auth()->user()->full_name }}</strong> (not
              <strong>{{ auth()->user()->full_name }}</strong>? <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>)
            </p>
            <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses,
              and <a href="{{ route('account.edit', auth()->user()->username) }}">edit your password and account
                details</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- My Account Area -->
@endsection
