<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
  public function index()
  {
    // Cart::instance('shopping')->destroy();
    $banners = Banner::where('status', 'active')->where('condition', 'banner')->orderBy('id', 'DESC')->limit(4)->get();
    $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->limit(3)->get();
    $products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(10)->get();
    return view("frontend.index", compact(['banners', 'categories', 'products']));
  }

  public function categoryProduct($slug): View
  {
    $category = Category::where('slug', $slug)
      ->with([
        'products' => function ($query) {
          $query->with('brand');
        }
      ])
      ->first();

    if ($category) {
      return view('frontend.pages.category-product', compact('category'));
    } else {
      abort(404, 'Page not found');
    }
  }

  public function productDetails($slug): View
  {
    $product = Product::where('slug', $slug)->with([
      'vendor',
      'brand',
      'category',
      'childCategory' => function ($query) {
        $query->with('parent');
      },
      'related_products' => function ($query) {
        $query->with('brand:id,title');
      }
    ])->first();
    if ($product) {
      return view('frontend.pages.product-details', compact('product'));
    } else {
      abort(404, 'Page not found');
    }
  }

  public function accountDetails(): View
  {
    return view('frontend.pages.my-account');
  }

  public function accountEdit(): View
  {
    return view('frontend.pages.account.edit-details');
  }

  public function accountUpdate(Request $request): RedirectResponse
  {

    $user = User::find(Auth::id());

    if ($request->full_name) {
      $user->full_name = $request->full_name;
    }

    if ($request->password) {
      $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed',
      ]);
      if (Hash::check($request->current_password, $user->password)) {
        $user->password = Hash::make($request->password);
      } else {
        return back()->withErrors(['current_password' => 'Current password does not match']);
      }
    }

    if ($request->username || $request->password) {
      $user->update();
    }

    return back()->with('success', 'Account details updated successfully');
  }

  public function accountOrders(): View
  {
    return view('frontend.pages.account.orders');
  }

  public function accountAddress(): View
  {
    $user = Auth::user();
    $billing_address = $user->billingAddress;
    $shipping_address = $user->shippingAddress;
    return view('frontend.pages.account.address', compact(['user', 'billing_address', 'shipping_address']));
  }

  public function billingAddress(Request $request): RedirectResponse
  {
    $user = User::find(Auth::id());
    $user->billingAddress()->updateOrCreate($request->all());
    return back();
  }
  public function shippingAddress(Request $request): RedirectResponse
  {
    $user = User::find(Auth::id());
    $user->shippingAddress()->updateOrCreate($request->all());
    return back();
  }
}