<table class="table table-bordered mb-30">
  <thead>
    <tr>
      <th scope="col"><i class="icofont-ui-delete"></i></th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse (Cart::instance('wishlist')->content() as $item)
      <tr>
        <th scope="row">
          <i class="icofont-close" id="removeWishlistItem" data-id="{{ $item->rowId }}"></i>
        </th>
        <td>
          <img src="{{ asset('storage/' . $item->model->photo) }}" alt="Product">
        </td>
        <td>
          <a href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
        </td>
        <td>{{ $item->model->price }}</td>
        <td>
          <button data-id="{{ $item->model->id }}" data-rowId="{{ $item->rowId }}"
            class="btn btn-primary addToCart{{ $item->model->id }}" id="addToCart">Add to
            Cart</button>
        </td>
      </tr>

    @empty
    @endforelse
  </tbody>
</table>
