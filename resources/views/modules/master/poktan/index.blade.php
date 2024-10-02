@extends('layouts.app')
@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Kelompok Tani</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Master Data</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Kelompok Tani</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid gap-5">
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="sub_district_code" id="update_sub_district" data-control="select2" data-placeholder="Pilih Kelurahan">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table id="example" class="table table-rounded table-striped border gy-5 gs-5 w-100">
                    <thead>
                        <tr class="fw-bold">
                            <th class="text-nowrap px-2">KELOMPOK TANI</th>
                            <th class="text-nowrap px-2">KODE DESA</th>
                            <th class="text-nowrap px-2">PROVINSI</th>
                            <th class="text-nowrap px-2">KOTA/KABUPATEN</th>
                            <th class="text-nowrap px-2">KECAMATAN</th>
                            <th class="text-nowrap px-2">KELURAHAN</th>
                            <th class="text-nowrap px-2">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle"></tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
@endsection
@section('script')
<script src="{{ asset('js/custom/apps/poktan/list/form.js') }}"></script>
<script>
    // set param
    let subdistrict = '';

    // list table data pengajuan
    let table = (subdistrict) => {
        return $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            paginate: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, "All"],
            "searching": true,
            dom:
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            ajax: {
                url: 'api/poktan', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    subdistrict: subdistrict
                }
            },
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'sub_district_code',
                    name: 'sub_district_code'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'district',
                    name: 'district'
                },
                {
                    data: 'sub_district',
                    name: 'sub_district'
                },
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Kelompok Tani";

        // aktifkan menu
        $("#master-data").addClass("show");
        $("#master-data-sub").addClass("show");
        $("#menu-poktan").addClass("active");

        // panggil datatable
        table(subdistrict);

        // --- BEGIN : KELURAHAN ---
        // list select data pilih kelurahan
        $(function(){
            $("#update_sub_district").select2({
                // minimumInputLength: 2,
                ajax: {
                    url: 'api/areas-sub-district',
                    dataType: 'json',
                    type: "get",
                    data: function (term) {
                        return {
                            search: term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.sub_district,
                                    id: item.sub_district_code
                                }
                            })
                        };
                    }

                }
            });
        })

        // apply filter kelurahan
        $("#update_sub_district").change(function () {
            subdistrict = $(this).val();
            table(subdistrict);
        })
        // --- END : KELURAHAN ---
    });
</script>
@endsection
