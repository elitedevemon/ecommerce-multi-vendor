<table class="table table-bordered mb-30">
  <thead>
    <tr>
      <th scope="col">SI</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
      <th scope="col"><i class="icofont-ui-delete"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach (Cart::instance('shopping')->content() as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
          <img src="{{ asset('storage/' . $item->model->photo) }}" alt="Product">
        </td>
        <td>
          <a href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
        </td>
        <td>{{ $item->model->price }}</td>
        <td>
          <div class="quantity">
            <input type="number" class="qty-text table-qty" id="qty{{ $item->rowId }}" step="1" min="1"
              max="{{ $item->model->stock }}" name="quantity" value="{{ $item->qty }}" data-id="{{ $item->rowId }}"
              data-stock="{{ $item->model->stock }}">
          </div>
        </td>
        <td id="subtotal{{ $item->rowId }}">${{ $item->subtotal }}</td>
        <th scope="row">
          <i class="icofont-close" id="removeTableItem" data-id="{{ $item->rowId }}"></i>
        </th>
      </tr>
    @endforeach
  </tbody>
</table>
