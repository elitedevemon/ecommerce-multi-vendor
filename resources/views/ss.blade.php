<form action="{{ route('banner.destroy', $banner->id) }}" method="post">
  @csrf
  @method('DELETE')
  <a href="" data-id="{{ $banner->id }}" class="dltBtn btn btn-danger">Delete</a>
</form>
<script script script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.dltBtn').click(function(e) {
    var form = $(this).closest('form');
    var dataID = $(this).data('id');
    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
      }
    });
  })
</script>
