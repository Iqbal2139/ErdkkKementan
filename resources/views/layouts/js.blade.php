<script>var hostUrl = "/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
{{-- <script src="{{ asset('js/custom/apps/user-management/users/list/table.js') }}"></script> --}}
{{-- <script src="{{ asset('js/custom/apps/user-management/users/list/export-users.js') }}"></script> --}}
{{-- <script src="{{ asset('js/custom/apps/user-management/users/list/add.js') }}"></script> --}}
{{-- <script src="{{ asset('js/widgets.bundle.js') }}"></script> --}}
{{-- <script src="{{ asset('js/custom/widgets.js') }}"></script> --}}
{{-- <script src="{{ asset('js/custom/apps/chat/chat.js') }}"></script> --}}
{{-- <script src="{{ asset('js/custom/utilities/modals/upgrade-plan.js') }}"></script> --}}
<script src="{{ asset('js/custom/utilities/modals/create-campaign.js') }}"></script>
{{-- <script src="{{ asset('js/custom/utilities/modals/users-search.js') }}"></script> --}}
<!--end::Custom Javascript-->
<script>
    $('#kt_app_sidebar_toggle').click( function() {
        if ($(this).hasClass('active') === false) {
            $("#d-n-mini").addClass('d-none');
        } else {
            $("#d-n-mini").removeClass('d-none');
        }
    })

    if (themeMode == "light") {
        $("#kt_app_main").addClass("bc-light");
        $("#kt_app_header").addClass("bc-light");
    }

    $(document).ready(function() {
        // nonaktif menu sebelumnya
        $(".menu-accordion").removeClass("active");
        $(".menu-sub-accordion").removeClass("active");
        $(".menu-link").removeClass("active");
    })
</script>
