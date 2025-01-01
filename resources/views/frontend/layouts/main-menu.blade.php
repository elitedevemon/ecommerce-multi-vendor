<!-- Top Header Area -->
<div class="top-header-area">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-6">
        <div class="welcome-note">
          <span class="popover--text" data-toggle="popover" data-content="Welcome to Bigshop ecommerce template."><i
              class="icofont-info-square"></i></span>
          <span class="text">Welcome to Bigshop ecommerce template.</span>
        </div>
      </div>
      <div class="col-6">
        <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
          <!-- Language Dropdown -->
          <div class="language-dropdown">
            <div class="dropdown">
              <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                English
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" href="#">Bangla</a>
                <a class="dropdown-item" href="#">Arabic</a>
              </div>
            </div>
          </div>

          <!-- Currency Dropdown -->
          <div class="currency-dropdown">
            <div class="dropdown">
              <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                $ USD
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                <a class="dropdown-item" href="#">৳ BDT</a>
                <a class="dropdown-item" href="#">€ Euro</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Menu -->
<div class="bigshop-main-menu">
  <div class="container">
    <div class="classy-nav-container breakpoint-off">
      <nav class="classy-navbar" id="bigshopNav">

        <!-- Nav Brand -->
        <a href="{{ route('welcome') }}" class="nav-brand"><img src="{{ asset('frontend/img/core-img/logo.png') }}"
            alt="logo"></a>

        <!-- Toggler -->
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"><span></span><span></span><span></span></span>
        </div>

        <!-- Menu -->
        <div class="classy-menu">
          <!-- Close -->
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>

          <!-- Nav -->
          <div class="classynav">
            <ul>
              <li><a href="#">Home</a>
                <ul class="dropdown">
                  <li><a href="index-1.html">Home - 1</a></li>
                  <li><a href="index-2.html">Home - 2</a></li>
                  <li><a href="index-3.html">Home - 3</a></li>
                </ul>
              </li>
              <li><a href="#">Shop</a>
                <ul class="dropdown">
                  <li><a href="#">Shop Grid</a>
                    <ul class="dropdown">
                      <li><a href="shop-grid-left-sidebar.html">Shop Grid Left Sidebar</a>
                      </li>
                      <li><a href="shop-grid-right-sidebar.html">Shop Grid Right
                          Sidebar</a></li>
                      <li><a href="shop-grid-top-sidebar.html">Shop Grid Top Sidebar</a>
                      </li>
                      <li><a href="shop-grid-no-sidebar.html">Shop Grid No Sidebar</a>
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">Shop List</a>
                    <ul class="dropdown">
                      <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a>
                      </li>
                      <li><a href="shop-list-right-sidebar.html">Shop List Right
                          Sidebar</a></li>
                      <li><a href="shop-list-top-sidebar.html">Shop List Top Sidebar</a>
                      </li>
                      <li><a href="shop-list-no-sidebar.html">Shop List No Sidebar</a>
                      </li>
                    </ul>
                  </li>
                  <li><a href="product-details.html">Single Product</a></li>
                  <li><a href="cart.html">Cart</a></li>
                  <li><a href="#">Checkout</a>
                    <ul class="dropdown">
                      <li><a href="checkout-1.html">Login</a></li>
                      <li><a href="checkout-2.html">Billing</a></li>
                      <li><a href="checkout-3.html">Shipping Method</a></li>
                      <li><a href="checkout-4.html">Payment Method</a></li>
                      <li><a href="checkout-5.html">Review</a></li>
                      <li><a href="checkout-complate.html">Complate</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Account Page</a>
                    <ul class="dropdown">
                      <li><a href="my-account.html">- Dashboard</a></li>
                      <li><a href="order-list.html">- Orders</a></li>
                      <li><a href="downloads.html">- Downloads</a></li>
                      <li><a href="addresses.html">- Addresses</a></li>
                      <li><a href="account-details.html">- Account Details</a></li>
                    </ul>
                  </li>
                  <li><a href="wishlist.html">Wishlist</a></li>
                  <li><a href="compare.html">Compare</a></li>
                </ul>
              </li>
              <li><a href="#">Pages</a>
                <div class="megamenu">
                  <ul class="single-mega cn-col-4">
                    <li><a href="about-us.html">- About Us</a></li>
                    <li><a href="faq.html">- FAQ</a></li>
                    <li><a href="contact.html">- Contact</a></li>
                    <li><a href="login.html">- Login &amp; Register</a></li>
                    <li><a href="404.html">- 404</a></li>
                    <li><a href="500.html">- 500</a></li>
                  </ul>
                  <ul class="single-mega cn-col-4">
                    <li><a href="my-account.html">- Dashboard</a></li>
                    <li><a href="order-list.html">- Orders</a></li>
                    <li><a href="downloads.html">- Downloads</a></li>
                    <li><a href="addresses.html">- Addresses</a></li>
                    <li><a href="account-details.html">- Account Details</a></li>
                    <li><a href="coming-soon.html">- Coming Soon</a></li>
                  </ul>
                  <div class="single-mega cn-col-2">
                    <div class="megamenu-slides owl-carousel">
                      <a href="shop-grid-left-sidebar.html">
                        <img src="{{ asset('frontend/img/bg-img/mega-slide-2.jpg') }}" alt="">
                      </a>
                      <a href="shop-list-left-sidebar.html">
                        <img src="{{ asset('frontend/img/bg-img/mega-slide-1.jpg') }}" alt="">
                      </a>
                    </div>
                  </div>
                </div>
              </li>
              <li><a href="#">Blog</a>
                <ul class="dropdown">
                  <li><a href="blog-with-left-sidebar.html">Blog Left Sidebar</a></li>
                  <li><a href="blog-with-right-sidebar.html">Blog Right Sidebar</a></li>
                  <li><a href="blog-with-no-sidebar.html">Blog No Sidebar</a></li>
                  <li><a href="single-blog.html">Single Blog</a></li>
                </ul>
              </li>
              <li><a href="#">Elements</a>
                <div class="megamenu">
                  <ul class="single-mega cn-col-4">
                    <li><a href="accordian.html">- Accordions</a></li>
                    <li><a href="alerts.html">- Alerts</a></li>
                    <li><a href="badges.html">- Badges</a></li>
                    <li><a href="blockquotes.html">- Blockquotes</a></li>
                  </ul>
                  <ul class="single-mega cn-col-4">
                    <li><a href="breadcrumb.html">- Breadcrumbs</a></li>
                    <li><a href="buttons.html">- Buttons</a></li>
                    <li><a href="forms.html">- Forms</a></li>
                    <li><a href="gallery.html">- Gallery</a></li>
                  </ul>
                  <ul class="single-mega cn-col-4">
                    <li><a href="heading.html">- Headings</a></li>
                    <li><a href="icon-fontawesome.html">- Icon FontAwesome</a></li>
                    <li><a href="icon-icofont.html">- Icon Ico Font</a></li>
                    <li><a href="labels.html">- Labels</a></li>
                  </ul>
                  <ul class="single-mega cn-col-4">
                    <li><a href="modals.html">- Modals</a></li>
                    <li><a href="pagination.html">- Pagination</a></li>
                    <li><a href="progress-bars.html">- Progress Bars</a></li>
                    <li><a href="tables.html">- Tables</a></li>
                  </ul>
                </div>
              </li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
        </div>

        <!-- Hero Meta -->
        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
          <!-- Search -->
          <div class="search-area">
            <div class="search-btn"><i class="icofont-search"></i></div>
            <!-- Form -->
            <div class="search-form">
              <input type="search" class="form-control" placeholder="Search">
              <input type="submit" class="d-none" value="Send">
            </div>
          </div>

          <!-- Wishlist -->
          <a href="{{ route('wishlist.index') }}">
            <div class="wishlist-area cart-area">
              <div class="cart--btn"><i class="icofont-heart"></i> <span
                  class="cart_quantity {{ Cart::instance('wishlist')->count() > 0 ? '' : 'd-none' }}">{{ Cart::instance('wishlist')->count() }}</span>
              </div>
            </div>
          </a>

          <!-- Cart -->
          <div class="cart-area">
            <div class="cart--btn"><i class="icofont-cart"></i> <span
                class="cart_quantity {{ Cart::instance('shopping')->count() > 0 ? '' : 'd-none' }}">{{ Cart::instance('shopping')->count() }}</span>
            </div>

            <!-- Cart Dropdown Content -->
            @if (Cart::instance('shopping')->count() > 0)
              <div class="cart-dropdown-content">
                <ul class="cart-list">
                  @foreach (Cart::instance('shopping')->content() as $item)
                    <li>
                      <div class="cart-item-desc">
                        <a href="{{ route('product.details', $item->model->slug) }}" class="image">
                          <img src="{{ asset('storage/' . $item->model->photo) }}" class="cart-thumb"
                            alt="">
                        </a>
                        <div>
                          <a href="{{ route('product.details', $item->model->slug) }}">{{ $item->model->title }}</a>
                          <p>{{ $item->qty }} x - <span class="price">{{ $item->model->price }}</span></p>
                        </div>
                      </div>
                      <span data-id="{{ $item->rowId }}" data-blade="main-menu" class="dropdown-product-remove"
                        id="removeItem"><i class="icofont-bin"></i></span>
                    </li>
                  @endforeach
                </ul>
                <div class="cart-pricing my-4">
                  <ul>
                    <li>
                      <span>Sub Total:</span>
                      <span>${{ Cart::instance('shopping')->subtotal }}</span>
                    </li>
                  </ul>
                </div>
                <div class="cart-box">
                  <a href="{{ route('cart.index') }}" class="btn btn-primary d-block">Go to Cart</a>
                </div>
              </div>
            @endif
          </div>
          @auth
            <!-- Account -->
            <div class="account-area">
              <div class="user-thumbnail">
                @if (auth()->user()->photo)
                  <img style="height: 30px; width: 30px;" src="{{ asset('storage/' . auth()->user()->photo) }}"
                    alt="user-image">
                @else
                  <img style="height: 30px; width: 30px;"
                    src="{{ asset('storage/images/users/profile-picture.webp') }}" alt="user-image">
                @endif
              </div>
              <ul class="user-meta-dropdown">
                <li class="user-title"><span>Hello,</span> {{ auth()->user()->full_name }}</li>
                <li @class(['d-none' => Route::is('account.details')])><a href="{{ route('account.details', auth()->user()->username) }}">My
                    Account</a></li>
                <li><a href="order-list.html">Orders List</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
                <li>
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="icon-menu">
                    <i class="icofont-logout"></i> Logout
                  </a>
                  <form action="{{ route('logout') }}" id="logout-form" method="post">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          @endauth
          @guest
            <div class="account-area">
              <a href="{{ route('login') }}"><i class="icofont-logout"></i> Login & Register</a>
            </div>
          @endguest
        </div>
      </nav>
    </div>
  </div>
</div>
