@extends('frontend.layouts.master')
@section('title', '419 | Page Expired')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>419</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">419</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Not Found Area -->
  <section class="error_page text-center section_padding_100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
          <div class="not-found-text">
            <h2>419</h2>
            <h5 class="mb-3">Page Expired</h5>
            <p>Sorry! the page you looking for is expired. Please try again.</p>
            <a href="{{ route('welcome') }}" class="btn btn-primary mt-3"><i class="fa fa-home" aria-hidden="true"></i> GO
              HOME</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Not Found Area End -->
@endsection
