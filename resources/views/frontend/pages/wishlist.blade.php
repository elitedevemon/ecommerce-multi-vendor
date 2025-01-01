@extends('frontend.layouts.master')
@section('title', 'Cart')
@section('contents')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h5>Wishlist</h5>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item active">Wishlist</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcumb Area -->

  <!-- Wishlist Table Area -->
  <div class="wishlist-table section_padding_100 clearfix">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="cart-table wishlist-table">
            <div class="table-responsive" id="wishlistTable">
              @include('frontend.pages.partials.wishlist-table')
            </div>
          </div>

          <div class="cart-footer text-right">
            <div class="back-to-shop">
              <a href="{{ route('wishlist.add-all-item') }}" id="addAllWishlistItem" onclick="addAllItem()"
                class="btn btn-primary">Add All
                Item</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Wishlist Table Area -->
@endsection
