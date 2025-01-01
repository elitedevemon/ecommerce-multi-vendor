<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $coupons = Coupon::orderBy('id', 'DESC')->get();
    return view('backend.coupon.index', compact('coupons'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('backend.coupon.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'code' => 'required|string',
      'type' => 'required|in:fixed,percent',
      'value' => 'required|numeric',
      'expiry_date' => 'required|date',
      'status' => 'required|in:active,inactive',
    ]);
    Coupon::create($request->all());
    return redirect()->route('coupon.index')->with('success', 'Coupon created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(Coupon $coupon)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Coupon $coupon)
  {
    if ($coupon) {
      return view('backend.coupon.edit', compact('coupon'));
    } else {
      return "Data not found";
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Coupon $coupon): RedirectResponse
  {
    $request->validate([
      'code' => 'required|string',
      'type' => 'required|in:fixed,percent',
      'value' => 'required|numeric',
      'expiry_date' => 'required|date',
      'status' => 'required|in:active,inactive',
    ]);
    $coupon->update($request->all());
    return redirect()->route('coupon.index')->with('success', 'Coupon created successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Coupon $coupon)
  {
    if ($coupon) {
      try {
        $coupon->delete();
        return back()->with("success", "Coupon successfully deleted");
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    return back()->with('error', 'Something went wrong');
  }

  public function couponStatusUpdate(Request $request): JsonResponse
  {
    switch ($request->mode) {
      case 'true':
        Coupon::where('id', $request->id)->update([
          'status' => 'active'
        ]);
        break;
      default:
        Coupon::where('id', $request->id)->update([
          'status' => 'inactive'
        ]);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
  }
}