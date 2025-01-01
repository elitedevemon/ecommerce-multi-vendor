<!-- Modal -->
<div class="modal fade" id="productView-{{ $product->id }}" tabindex="-1" role="dialog"
  aria-labelledby="productView-{{ $product->id }}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productView-{{ $product->id }}Title">{{ Str::limit($product->title, 30) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->title }}" class="img-fluid">
          </div>
          <div class="col-6 mt-3">
            <div>
              <strong>Summary</strong>
              <p>{!! html_entity_decode(Str::limit($product->summary, 15)) !!}</p>
            </div>
            <div>
              <strong>Description</strong>
              <p>{!! html_entity_decode(Str::limit($product->description, 15)) !!}</p>
            </div>
            <div>
              <strong>Stock</strong>
              <p>{{ $product->stock }}</p>
            </div>
            <div>
              <strong>Price</strong>
              <p>{{ $product->price }}</p>
            </div>
            <div>
              <strong>Offer Price</strong>
              <p>{{ $product->offer_price }}</p>
            </div>
          </div>
          <div class="col-6 mt-3">
            <div>
              <strong>Vendor</strong>
              <p>{{ $product->vendor->full_name }}</p>
            </div>
            <div>
              <strong>Status</strong>
              <p class="badge bade-primary">{{ $product->status }}</p>
            </div>
            <div>
              <strong>Discount</strong>
              <p>{{ $product->discount }}</p>
            </div>
            <div>
              <strong>Size</strong>
              <p class="badge bade-primary">{{ $product->size }}</p>
            </div>
            <div>
              <strong>Condition</strong>
              <p class="badge bade-primary">{{ $product->condition }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
