<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Javascript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script script script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('backend/assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{ asset('backend/assets/bundles/morrisscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/knob.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/ui/sortable-nestable.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>

<!-- create banner -->
<script src="{{ asset('backend/assets/vendor/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/forms/dropify.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<!-- main script -->
<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>

@yield('scripts')
