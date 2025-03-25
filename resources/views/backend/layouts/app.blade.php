<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="#">
    <link rel="apple-touch-icon" href="#">
    <title>Super Admin</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?v=') }}{{ rand(1000,9999) }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/toastify.min.css') }}">
    
    

    <style>
        body {
            font-size: 12px;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!! translate('Nothing selected', null, true) !!}',
            nothing_found: '{!! translate('Nothing found', null, true) !!}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper">
        @include('backend.inc.admin_sidenav')
        <div class="aiz-content-wrapper">
            @include('backend.inc.admin_nav')
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    @yield('content')
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    {{-- <p class="mb-0">&copy; {{ get_setting('site_name') }} v{{ get_setting('current_version') }}</p> --}}
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    @yield('modal')


    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js?v=') }}{{ rand(1000,9999) }}"></script>
    <script src="{{ static_asset('assets/js/toastify-js.js') }}"></script>

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

        function form_submit(number, isRedirectSamePage = false) {
            if (document.getElementById("form_"+number).checkValidity()) { 
                $('#submit_button_'+number).hide();
                if(isRedirectSamePage) {
                    $('#isRedirectSamePage').val(1);
                    $('#submitBtnForRedirectBack_' + number).hide();
                }
                $('#processing_button_'+number).show();
            }
            else {
                errorMessage("Something is missing!");
            }
        }

        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>

    @if(session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            close: true,
            backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
            className: "success",
        }).showToast();
        var play = document.getElementById('success').play();
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
        var play = document.getElementById('error').play();
    </script>
    @endif

    @yield('script')

</body>

</html>
