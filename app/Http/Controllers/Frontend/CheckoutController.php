<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\GuestOrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CheckoutController extends Controller
{
  public function guestOrRegister(Request $request)
  {
    switch ($request->option) {
      case "guest":
        $guestId = time() . uniqid() . rand(0, 99999);
        session()->put("guest_id", $guestId);
        return redirect()->route("checkout.guest.index", $guestId);
      case "register":
        return redirect()->route("checkout.auth.billing");
      default:
        return redirect()->back();
    }
  }

  //auth login
  public function authLogin(LoginRequest $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);
    $user = DB::table('users')->where('email', $request->email)->first();
    if ($user && Hash::check($request->password, $user->password)) {
      $request->authenticate();

      $request->session()->regenerate();

      if (Auth::user()->status === 'active') {
        return back();
      }
      Auth::logout();
      abort(500, 'Your account is inactive');
    }
    return back()->with('error', 'Invalid credentials');
  }

  //auth functions
  public function index()
  {
    return view("frontend.pages.checkout.index");
  }

  public function checkoutBilling()
  {
    $address = Auth::user()->authOrderAddresses->first();
    return view("frontend.pages.checkout.billing", compact('address'));
  }

  public function authCheckoutOrderAddress(Request $request)
  {
    $user = User::find(Auth::id());
    if ($request->add_different_shipping) {
      $request->validate([
        'b_recipient' => 'required|string',
        'b_phone' => 'required|string',
        'b_email' => 'required|email',
        'b_country' => 'required|string',
        'b_city' => 'required|string',
        'b_state' => 'required|string',
        'b_street_address' => 'required|string',
        'b_post_code' => 'required|string',
        'b_apartment' => 'nullable|string',
        'b_notes' => 'nullable|string',
        's_recipient' => 'required|string',
        's_phone' => 'required|string',
        's_email' => 'required|email',
        's_country' => 'required|string',
        's_city' => 'required|string',
        's_state' => 'required|string',
        's_street_address' => 'required|string',
        's_post_code' => 'required|string',
        's_apartment' => 'nullable|string',
        's_delivery_address' => 'required|string',
        's_notes' => 'nullable|string',
      ]);
      $user->authOrderAddresses()->create($request->except('add_different_shipping'));
    } else {
      $data = $request->validate([
        'b_recipient' => 'required|string',
        'b_phone' => 'required|string',
        'b_email' => 'required|email',
        'b_country' => 'required|string',
        'b_city' => 'required|string',
        'b_state' => 'required|string',
        'b_street_address' => 'required|string',
        'b_post_code' => 'required|string',
        'b_apartment' => 'nullable|string',
        'b_notes' => 'nullable|string',
      ]);
      $user->authOrderAddresses()->create($data);
    }
    return back();
  }

  //guest functions
  public function guestCheckoutBilling()
  {
    return view("frontend.pages.checkout.guest.billing");
  }

  public function guestCheckoutOrderAddressStore(Request $request)
  {
    if ($request->add_different_shipping) {
      $request->validate([
        'b_recipient' => 'required|string',
        'b_phone' => 'required|string',
        'b_email' => 'required|email',
        'b_country' => 'required|string',
        'b_city' => 'required|string',
        'b_state' => 'required|string',
        'b_street_address' => 'required|string',
        'b_post_code' => 'required|string',
        'b_apartment' => 'nullable|string',
        'b_notes' => 'nullable|string',
        's_recipient' => 'required|string',
        's_phone' => 'required|string',
        's_email' => 'required|email',
        's_country' => 'required|string',
        's_city' => 'required|string',
        's_state' => 'required|string',
        's_street_address' => 'required|string',
        's_post_code' => 'required|string',
        's_apartment' => 'nullable|string',
        's_delivery_address' => 'required|string',
        's_notes' => 'nullable|string',
      ]);
      GuestOrderAddress::create($request->except('add_different_shipping'));
    } else {
      $data = $request->validate([
        'b_recipient' => 'required|string',
        'b_phone' => 'required|string',
        'b_email' => 'required|email',
        'b_country' => 'required|string',
        'b_city' => 'required|string',
        'b_state' => 'required|string',
        'b_street_address' => 'required|string',
        'b_post_code' => 'required|string',
        'b_apartment' => 'nullable|string',
        'b_notes' => 'nullable|string',
      ]);
      GuestOrderAddress::create($data);
    }
    return back();
  }

}