<div class="my-account-navigation mb-50">
  <ul>
    <!--account details-->
    <li @class(['active' => Route::is('account.details')])><a href="{{ route('account.details', auth()->user()->username) }}">Dashboard</a>
    </li>
    <!--orders-->
    <li @class(['active' => Route::is('account.orders')])><a href="{{ route('account.orders', auth()->user()->username) }}">Orders</a></li>
    <!--addresses-->
    <li @class(['active' => Route::is('account.address')])><a href="{{ route('account.address', auth()->user()->username) }}">Addresses</a>
    </li>
    <!--edit account details-->
    <li @class(['active' => Route::is('account.edit')])><a href="{{ route('account.edit', auth()->user()->username) }}">Account Details</a>
    </li>
    <!--logout-->
    <li>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout </a>
      <form action="{{ route('logout') }}" id="logout-form" method="post">
        @csrf
      </form>
    </li>
  </ul>
</div>
