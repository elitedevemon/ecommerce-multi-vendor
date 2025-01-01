<!-- Modal -->
<div class="modal fade overflow-auto h-screen" id="billingAddress" data-backdrop="static" tabindex="-1" role="dialog"
  aria-labelledby="billingAddressTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="billingAddressTitle">Add/Update Billing address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('account.billing.address') }}" method="POST" id="billing_address">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" name="recipient" class="form-control" id="recipient-name"
              placeholder="Recipient Name (optional)">
          </div>
          <div class="form-group">
            <label for="street_address" class="col-form-label">Street Address: <span
                class="text-danger">*</span></label>
            <input type="text" name="street_address" class="form-control" id="street_address"
              placeholder="Street Address">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="city" class="col-form-label">City: <span class="text-danger">*</span></label>
              <input type="text" name="city" class="form-control" id="city" placeholder="City">
            </div>
            <div class="form-group col-md-6">
              <label for="state" class="col-form-label">State: <span class="text-danger">*</span></label>
              <input type="text" name="state" class="form-control" id="state"
                placeholder="State/Province/Region">
            </div>
            <div class="form-group col-md-6">
              <label for="zip" class="col-form-label">Zip/Postal Code: <span class="text-danger">*</span></label>
              <input type="text" name="post_code" class="form-control" id="zip" placeholder="Zip/Postal Code">
            </div>
            <div class="form-group col-md-6">
              <label for="country" class="col-form-label">Country: <span class="text-danger">*</span></label>
              <input type="text" name="country" class="form-control" id="country" placeholder="Country Name">
            </div>
          </div>
          <div class="form-group">
            <label for="apartment" class="col-form-label">Apartment:</label>
            <input type="text" name="apartment" class="form-control" id="apartment"
              placeholder="Apartment, suite, unit etc. (optional)">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="phone" class="col-form-label">Phone:</label>
              <input type="text" name="phone" class="form-control" id="phone"
                placeholder="Phone Number (optional)">
            </div>
            <div class="form-group col-md-6">
              <label for="email" class="col-form-label">Email:</label>
              <input type="text" name="email" class="form-control" id="email"
                placeholder="Email Address (optional)">
            </div>
          </div>
          <div class="form-group">
            <label for="note" class="col-form-label">Notes:</label>
            <textarea class="form-control" name="notes" id="note"
              placeholder="Notes about your order, e.g. special notes for delivery (optional)"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"
          onclick="document.getElementById('billing_address').submit()">Save
          changes</button>
      </div>
    </div>
  </div>
</div>
