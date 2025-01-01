@extends('backend.layouts.master')

@section('main-content')
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="{{ url()->previous() }}" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                  class="fa fa-arrow-left"></i></a> Coupon</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">Coupon</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="header">
              <h2><strong>Coupon</strong> List ({{ count($coupons) }})</h2>
              <ul class="header-dropdown">
                <a href="{{ route('coupon.create') }}" class="btn btn-primary"><i style="font-size: 13px; width:15px"
                    class="fa fa-plus"></i>Create
                  Coupon</a>
              </ul>
            </div>
            <div class="body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th style="width:5%">No.</th>
                      <th>Code</th>
                      <th>Type</th>
                      <th>Value</th>
                      <th>Status</th>
                      <th style="width:18%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($coupons as $coupon)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>
                          @switch($coupon->type)
                            @case('fixed')
                              <span class="badge badge-success">{{ $coupon->type }}</span>
                            @break

                            @default
                              <span class="badge badge-info">{{ $coupon->type }}</span>
                          @endswitch
                        </td>
                        <td>{{ $coupon->value }}</td>
                        <!--status-->
                        <td>
                          <input type="checkbox" name="status" value="{{ $coupon->id }}"
                            {{ $coupon->status == 'active' ? 'checked' : '' }} data-toggle="toggle" data-on="Active"
                            data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <!--action-->
                        <td>
                          <!--edit button-->
                          <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-primary float-left ml-1"><i
                              class="icon-note"></i></a>
                          <!--delete button-->
                          <form action="{{ route('coupon.destroy', $coupon->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="" data-id="{{ $coupon->id }}"
                              class="dltBtn btn btn-danger float-left ml-1"><i class="icon-trash"></i></a>
                          </form>
                        </td>
                      </tr>
                      @empty
                        <tr>
                          <td colspan="8">
                            <strong>No data found</strong>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  @endsection

  @section('styles')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet">
  @endsection

  @section('scripts')
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
    <script>
      $('input[name=status]').change(function() {
        var mode = $(this).prop('checked');
        var id = $(this).val();
        // alert(id);
        if (confirm("Are you sure !!")) {
          $.ajax({
            type: "POST",
            url: "{{ route('coupon_status.update') }}",
            data: {
              _token: "{{ csrf_token() }}",
              mode: mode,
              id: id
            },
            success: function(response) {
              if (response.status) {
                alert(response.message);
              } else {
                alert("Please try again");
              }
            }
          });
        }
      })
    </script>
  @endsection
