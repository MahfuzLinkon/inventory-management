<script src="{{ asset('/') }}assets/public/graindashboard/js/graindashboard.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/graindashboard.vendor.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/toastr.min.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/select2.min.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/all.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/handlebars.min-v4.7.7.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/notify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectJs').select2();
    });
</script>

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>

<!-- DEMO CHARTS -->
<script src="{{ asset('/') }}assets/public/demo/resizeSensor.js"></script>
<script src="{{ asset('/') }}assets/public/demo/chartist.js"></script>
<script src="{{ asset('/') }}assets/public/demo/chartist-plugin-tooltip.js"></script>
<script src="{{ asset('/') }}assets/public/demo/gd.chartist-area.js"></script>
<script src="{{ asset('/') }}assets/public/demo/gd.chartist-bar.js"></script>
<script src="{{ asset('/') }}assets/public/demo/gd.chartist-donut.js"></script>
<script>
    $.GDCore.components.GDChartistArea.init('.js-area-chart');
    $.GDCore.components.GDChartistBar.init('.js-bar-chart');
    $.GDCore.components.GDChartistDonut.init('.js-donut-chart');
</script>
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    {{ Session::forget('success') }}
@endif
@if (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
    {{ Session::forget('error') }}
@endif
@yield('script')
