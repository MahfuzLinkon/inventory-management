<script src="{{ asset('/') }}assets/public/graindashboard/js/graindashboard.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/graindashboard.vendor.js"></script>
<script src="{{ asset('/') }}assets/public/graindashboard/js/toastr.min.js"></script>

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
@if (Session::has('erros'))
    <script>
        toastr.erros("{{ Session::get('erros') }}");
    </script>
    {{ Session::forget('erros') }}
@endif