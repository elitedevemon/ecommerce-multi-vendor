<div class="cart-total-area mb-30">
  <h5 class="mb-3">Cart Totals</h5>
  <div class="table-responsive">
    <table class="table mb-3">
      <tbody>
        <tr>
          <td>Sub Total</td>
          <td>${{ Cart::instance('shopping')->subtotal() }}</td>
        </tr>
        <tr>
          <td>Shipping</td>
          <td>$10.00</td>
        </tr>
        <tr>
          <td>VAT (5%)</td>
          <td>{{ Number::currency((Cart::instance('shopping')->subtotal(0, 0, '') * 5) / 100) }}</td>
        </tr>
        @session('coupon_value')
          <tr id="coupon">
            <td>Coupon</td>
            <td id="couponValue">${{ session()->get('coupon_value') }}</td>
          </tr>
        @endsession
        <tr>
          <td>Total</td>
          <td>
            {{ Number::currency(Cart::instance('shopping')->subtotal(0, 0, '') + 10 + (Cart::instance('shopping')->subtotal(0, 0, '') * 5) / 100 - (session()->has('coupon_value') ? session()->get('coupon_value') : 0)) }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <a href="{{ route('checkout.index') }}" onclick="proceedCheckout()" id="proceedCheckout"
    class="btn btn-primary d-block">Proceed To
    Checkout</a>
</div>
