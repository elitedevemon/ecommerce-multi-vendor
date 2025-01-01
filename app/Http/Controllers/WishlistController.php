<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WishlistController extends Controller
{
  public function index(): View
  {
    return view('frontend.pages.wishlist');
  }
  public function store(Request $request): JsonResponse
  {
    // Cart::instance('wishlist')->destroy();

    $product_id = $request->input("product_id");
    $product_qty = $request->input("product_qty");
    $cart = Cart::instance('wishlist')->content();

    $check_available = $cart->search(function ($cartItem, $rowId) use ($product_id): bool {
      return $cartItem->id === $product_id;
    });

    // return $check_available;

    if ($check_available) {
      return response()->json([
        "status" => false,
        "message" => "Product already in wishlist"
      ]);
    }

    $product = Product::find($product_id);
    $price = Str::after($product->price, '$');

    Cart::instance('wishlist')->add($product_id, $product->title, $product_qty, $price)->associate('App\Models\Product');

    $header = view('frontend.layouts.main-menu')->render();

    return response()->json([
      "status" => true,
      "header" => $header
    ]);
  }

  public function tableDestroy(Request $request)
  {
    $product_id = $request->input("id");
    Cart::instance('wishlist')->remove($product_id);

    $header1 = view('frontend.layouts.main-menu')->render();
    $header2 = view('frontend.pages.partials.wishlist-table')->render();

    if (Cart::instance('wishlist')->count() == 0) {
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

  // add to cart from wishlist
  public function addToCart(Request $request)
  {
    $rowId = $request->input("rowId");
    $product = Cart::instance('wishlist')->get($rowId);

    if ($product) {
      Cart::instance('shopping')->add($product->id, $product->name, $product->qty, $product->price)->associate('App\Models\Product');
      Cart::instance('wishlist')->remove($rowId);

      $header = view('frontend.layouts.main-menu')->render();
      $wishlistTable = view('frontend.pages.partials.wishlist-table')->render();

      return response()->json([
        "status" => true,
        "message" => "Product added to cart",
        "count" => Cart::instance('wishlist')->count(),
        "header" => $header,
        "wishlistTable" => $wishlistTable
      ]);
    }
    return response()->json([
      "status" => false,
      "message" => "Product not found"
    ]);
  }

  public function addAllItem()
  {
    $cart = Cart::instance('wishlist')->content();
    foreach ($cart as $item) {
      Cart::instance('shopping')->add($item->id, $item->name, $item->qty, $item->price)->associate('App\Models\Product');
    }
    Cart::instance('wishlist')->destroy();

    return redirect()->route('cart.index');
  }
}