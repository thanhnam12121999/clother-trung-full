<!-- Js Plugins -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
{{--<script src="{{ asset('user/js/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('user/js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.dd.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
{{--<script src="{{ asset('user/plugins/sweetalert2/sweetalert2.all.js') }}"></script>--}}
@include('sweetalert::alert')
<script src="{{ asset('user/js/main.js') }}"></script>
<script src="{{ asset('user/custom-js/script.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
@yield('custom-js')
@yield('my-js')
