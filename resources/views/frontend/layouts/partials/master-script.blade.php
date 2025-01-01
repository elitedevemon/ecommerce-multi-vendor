<script>
  // add to cart
  $(document).on('click', '.add_to_cart', function(e) {
    e.preventDefault();
    var product_id = $(this).data('product-id');
    var product_qty = $(this).data('product-qty');
    var token = "{{ csrf_token() }}";
    var path = "{{ route('cart.store') }}";

    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        product_id: product_id,
        product_qty: product_qty,
        _token: token
      },
      beforeSend: function() {
        $("#add_to_cart" + product_id).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
      },
      complete: function() {
        $("#add_to_cart" + product_id).html('Added');
      },
      success: function(response) {
        console.log(response);
        $('body #header_area').html(response.header);
      }
    })
  })

  // add to wishlist
  $(document).on('click', '.add_to_wishlist', function(e) {
    e.preventDefault();
    var product_id = $(this).data('product-id');
    var product_qty = $(this).data('product-qty');
    var token = "{{ csrf_token() }}";
    // return alert(product_qty);
    var path = "{{ route('wishlist.store') }}";

    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        product_id: product_id,
        product_qty: product_qty,
        _token: token
      },
      beforeSend: function() {
        $("#add_to_wishlist" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
      },
      complete: function(response) {
        if (response.responseJSON.status == false) {
          $("#add_to_wishlist" + product_id).html('<i class="icofont-heart"></i>');
        } else {
          $("#add_to_wishlist" + product_id).html('<i class="icofont-verification-check"></i>');
        }
      },
      success: function(response) {
        console.log(response);
        if (response.status == false) {
          alert(response.message);
        } else {
          $('body #header_area').html(response.header);
        }
      }
    })
  })

  // remove cart item from main menu
  $(document).on('click', '#removeItem', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = "{{ csrf_token() }}";
    var path = "{{ route('cart.remove') }}";
    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        id: id,
        _token: token
      },
      success: function(response) {
        console.log(response);
        $('body #header_area').html(response.header);
      }
    })
  });

  // remove cart item from cart table
  $(document).on('click', '#removeTableItem', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = "{{ csrf_token() }}";
    var path = "{{ route('cart.table.destroy') }}";
    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        id: id,
        _token: token
      },
      success: function(response) {
        console.log(response);
        $('body #header_area').html(response.header1);
        $('body #cartTable').html(response.header2);
        if (response.count == 0) {
          window.location.href = "/";
        }
      }
    })
  });

  // remove wishlist item from wishlist table
  $(document).on('click', '#removeWishlistItem', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = "{{ csrf_token() }}";
    var path = "{{ route('wishlist.table.destroy') }}";
    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        id: id,
        _token: token
      },
      success: function(response) {
        console.log(response);
        $('body #header_area').html(response.header1);
        $('body #wishlistTable').html(response.header2);
        if (response.count == 0) {
          window.location.href = "/";
        }
      }
    })
  });

  // add to cart from wishlist
  $(document).on('click', '#addToCart', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var rowId = $(this).data('rowid');
    // return alert(rowId);
    var token = "{{ csrf_token() }}";
    var path = "{{ route('wishlist.add-to-cart') }}";
    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      data: {
        rowId: rowId,
        _token: token
      },
      beforeSend: function() {
        $(".addToCart" + id).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
      },
      complete: function(response) {
        if (response.responseJSON.status == false) {
          $(".addToCart" + id).html('Add to Cart');
        } else {
          alert(response.responseJSON.message);
        }
      },
      success: function(response) {
        console.log(response);
        $('body #header_area').html(response.header);
        $('body #wishlistTable').html(response.wishlistTable);
        if (response.count == 0) {
          window.location.href = "/";
        }
      }
    })
  });

  $('.table-qty').change(function(e) {
    e.preventDefault();
    var qty = parseFloat($(this).val());
    var stock = $(this).data('stock');
    var id = $(this).data('id');
    var token = "{{ csrf_token() }}";
    $.ajax({
      type: "POST",
      url: "{{ route('cart.update') }}",
      data: {
        qty: qty,
        stock: stock,
        id: id,
        _token: token
      },
      dataType: "JSON",
      success: function(response) {
        $('body #header_area').html(response.header1);
        $('body #cartTotal').html(response.cartTotal);
        $('#cartTable #qty' + id).val(response.qty);
        $('#cartTable #subtotal' + id).html(response.subtotal);
      }
    });
  });

  $('#coupon_btn').click(function(e) {
    e.preventDefault();
    var code = $('input[name=coupon_code]').val();
    var token = "{{ csrf_token() }}";
    if (code == '') {
      alert('Enter a valid coupon');
    } else {
      $.ajax({
        type: "POST",
        url: "{{ route('cart.coupon') }}",
        data: {
          code: code,
          _token: token
        },
        dataType: "JSON",
        beforeSend: function() {
          $('#coupon_btn').html('<i class="fas fa-spinner fa-spin"></i> Applying...');
        },
        complete: function(response) {
          console.log(response.responseJSON.status);
          if (response.responseJSON.status === true) {
            $('#coupon_btn').html('Coupon Applied');
            $('#coupon_btn').attr('disabled', true);
          } else {
            $('#coupon_btn').html('Apply Coupon');
          }
        },
        success: function(response) {
          alert(response.message);
          $('body #cartTotal').html(response.cartTotal);
        }
      });
    }

  });

  function addAllItem() {
    $('#addAllWishlistItem').html('<i class="fa fa-spinner fa-spin"></i> Adding...');
  }
</script>
