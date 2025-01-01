<!-- Modal -->
<div class="modal fade" id="userView-{{ $user->id }}" tabindex="-1" role="dialog"
  aria-labelledby="userView-{{ $user->id }}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userView-{{ $user->id }}Title">{{ $user->full_name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row container">
          <div class="col-12">
            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->full_name }}" height="100" width="100"
              class="rounded-circle mx-auto d-block">
          </div>
          <div class="col-6 mt-3">
            <div>
              <strong>Name</strong>
              <p>{{ $user->full_name }}</p>
            </div>
            <div>
              <strong>Username</strong>
              <p>{{ $user->username }}</p>
            </div>
            <div>
              <strong>Email</strong>
              <p>{{ $user->email }}</p>
            </div>
          </div>
          <div class="col-6 mt-3">
            <div>
              <strong>Phone</strong>
              <p>{{ $user->phone }}</p>
            </div>
            <div class=" w-full overflow-clip">
              <strong>Address</strong>
              <p>{{ $user->address }}</p>
            </div>
            <div>
              <strong>Role</strong>
              <p><span
                  class="badge {{ $user->role == 'vendor' ? 'badge-warning' : 'badge-info' }} m-0">{{ $user->role }}</span>
              </p>
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
