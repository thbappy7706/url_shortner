<base href="">
<meta charset="utf-8" />
<title>Url Shortner </title>
<meta name="description" content="Updates and statistics" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
{{--<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />--}}
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{asset('assets/global/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="{{asset('assets/global/css/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{asset('assets/global/css/style.bundle.min.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<!--end::Layout Themes-->
<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
<style>
    .aside .aside-menu .menu-nav>.menu-item>.menu-link .menu-icon {
        padding-bottom: 0;
        font-size: 2.5rem;
    }
</style>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@stack('styles')
