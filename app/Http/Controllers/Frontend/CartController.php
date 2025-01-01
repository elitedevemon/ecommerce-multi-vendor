<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
  public function index()
  {
    return view('frontend.pages.cart');
  }
  public function store(Request $request)
  {
    $product_id = $request->input("product_id");
    $product_qty = $request->input("product_qty");
    $product = Product::find($product_id);
    $price = Str::after($product->price, '$');

    Cart::instance('shopping')->add($product_id, $product->title, $product_qty, $price)->associate('App\Models\Product');

    $header = view('frontend.layouts.main-menu')->render();

    return response()->json([
      "status" => true,
      "product_id" => $product_id,
      "total" => Cart::subtotal(),
      "cart_count" => Cart::instance('shopping')->count(),
      "header" => $header
    ]);
  }

  public function remove(Request $request)
  {
    $product_id = $request->input("id");
    Cart::instance('shopping')->remove($product_id);

    $header = view('frontend.layouts.main-menu')->render();

    return response()->json([
      "status" => true,
      "header" => $header
    ]);
  }

  public function tableDestroy(Request $request)
  {
    $product_id = $request->input("id");
    Cart::instance('shopping')->remove($product_id);

    $header1 = view('frontend.layouts.main-menu')->render();
    $header2 = view('frontend.pages.partials.cart-table')->render();

    if (Cart::instance('shopping')->count() == 0) {
      return response()->json([
        'count' => 0
      ]);
    }

    return response()->json([
      "status" => true,
      "header1" => $header1,
      "header2" => $header2
    ]);
  }

  public function update(Request $request)
  {
    $product_id = $request->input("id");
    Cart::instance('shopping')->update($product_id, $request->qty);

    $header1 = view('frontend.layouts.main-menu')->render();
    $cart_total = view('frontend.pages.partials.cart-total')->render();
    $product = Cart::instance('shopping')->get($product_id);

    if (session()->has('coupon_value')) {
      $coupon = Coupon::where('code', session()->get('coupon_code'))->first();
      $subtotal = Cart::instance('shopping')->subtotal(0, 0, '');
      session()->put([
        'coupon_code' => session()->get('coupon_code'),
        'coupon_value' => $coupon->discount($subtotal)
      ]);
    }

    return response()->json([
      "status" => true,
      'header1' => $header1,
      "qty" => $product->qty,
      "subtotal" => $product->subtotal(),
      "cartTotal" => $cart_total
    ]);
  }

  public function coupon(Request $request)
  {
    if ($request->code === null) {
      return response()->json([
        "status" => false,
        "message" => "Enter a valid coupon"
      ]);
    } else {
      $coupon = Coupon::where('code', $request->code)->first();
      if ($coupon && $coupon->status === 'active') {
        $subtotal = Cart::instance('shopping')->subtotal(0, 0, '');
        session()->put([
          'coupon_code' => $coupon->code,
          'coupon_value' => $coupon->discount($subtotal)
        ]);
        $cart_total = view('frontend.pages.partials.cart-total')->render();
        return response()->json([
          "status" => true,
          "message" => "Coupon added successfully",
          "cartTotal" => $cart_total
        ]);
      } else {
        return response()->json([
          "status" => false,
          "message" => "Enter a valid coupon"
        ]);
      }
    }

  }
}