<script src="{{ asset('frontend_asset/vendors/modernizr.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/jquery.easing.1.3.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/jquery.parallax-1.1.3.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/monkeysan.accordion.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/monkeysan.jquery.nav.1.0.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/monkeysan.validator.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/handlebars-v4.0.5.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/arcticmodal/jquery.arcticmodal-0.3.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/retina.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/sticky-sidebar.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/mad.customselect.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/countdown/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('frontend_asset/vendors/countdown/jquery.countdown.js') }}"></script>
<script src="{{ asset('frontend_asset/js/modules/mad.alert-box.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/modules/mad.newsletter-form.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/modules/mad.sticky-header-section.min.js') }}"></script>
<script src="{{ asset('frontend_asset/js/venobox.min.js') }}"></script>
{{-- <script src="{{ asset('frontend_asset/js/datepicker.js') }}"></script> --}}



<script src="{{ asset('frontend_asset/js/mad.app.js') }}"></script>
<script src="{{ asset('frontend_asset/js/main.js') }}"></script>
<script src="{{ static_asset('assets/js/toastify-js.js') }}"></script>

<script>
    new VenoBox({
        selector: '.glry',
        numeration: true,
        infinigall: true,
        share: true,
        spinner: 'rotating-plane'
    });
</script>

<script>
    function error(info) {
        Toastify({
            text: info,
            close: true,
            backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
            className: "error",
        }).showToast();
    }

    function errorMessage(info) {
        error(info);
    }
    
    function success(info) {
        Toastify({
            text: info,
            close: true,
            backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
            className: "success",
        }).showToast();
    }
</script>

@if(session('success'))
<script>
    Toastify({
        text: "{{ session('success') }}",
        close: true,
        backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
        className: "success",
    }).showToast();
</script>
@endif

@if(session('error'))
<script>
    Toastify({
        text: "{{ session('error') }}",
        close: true,
        backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
        className: "error",
    }).showToast();
</script>
@endif