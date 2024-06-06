<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Apr 2024 05:06:31 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>FD Shop - @if(!empty($header_title)) {{$header_title}} @endif</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('assets')}}/images/icons/favicon.png">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = "{{url('assets')}}/js/webfont.js";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{url('assets')}}/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{url('assets')}}/css/demo4.min.css">
    <link rel="stylesheet" href="{{url('assets')}}/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('styles')
</head>


<body>
    <div class="page-wrapper">

        @include('frontend.layouts.header')

        <!-- End .header -->



        <main class="main">

            @yield('content')

        </main>
        <!-- End .main -->

        @include('frontend.layouts.footer')
        <!-- End .footer -->

    </div>
    <!-- End .page-wrapper -->
 


    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{url('assets')}}/js/jquery.min.js"></script>
    <script src="{{url('assets')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('assets')}}/js/optional/isotope.pkgd.min.js"></script>
    <script src="{{url('assets')}}/js/plugins.min.js"></script>
    <script src="{{url('assets')}}/js/jquery.appear.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS File -->
    <script src="{{url('assets')}}/js/main.min.js"></script>

    @if(session('success'))
    <script>
        $.toast({
            heading: 'Thông báo',
            text: "{{session('success')}}",
            icon: 'success',
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600',  // To change the background
            position: 'top-center',
            hideAfter: 5000,
        })
        </script>
    @endif

    @if(session('error'))
    <script>
        $.toast({
            heading: 'Thông báo',
            text: "{{session('error')}}",
            icon: 'error',
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600',  // To change the background
            position: 'top-center',
            hideAfter: 5000,
        })
        </script>
    @endif

    @yield('scripts')
</body>
</html>

<