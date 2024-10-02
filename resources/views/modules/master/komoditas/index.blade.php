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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Komoditas</h1>
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
                    <li class="breadcrumb-item text-muted">Komoditas</li>
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
                        <select class="form-select form-select-solid" name="subsektor" id="subsektor" data-control="select2" data-placeholder="Pilih Subsektor">
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
                            <th class="text-nowrap px-2">KOMODITAS</th>
                            <th class="text-nowrap px-2">SUBSEKTOR</th>
                            <th class="text-nowrap px-2">AKSI</th>
                        </tr>
                    </thead>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
@section('script')
<script>
    let subsektor = '';

    // list table data pengajuan
    let table = () => {
        return $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            paginate: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, "All"],
            "searching": true,
            ajax: {
                url: 'api/pengajuan', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    subsektor: subsektor
                }
            },
            columns: [
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
                },
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
                },
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-warning btn-sm mx-1 update" data-id="'+data+'"><i class="ki-outline ki-notepad-edit fs-3 me-1"></i>Update</button>'+
                        '<button class="btn btn-success btn-sm mx-1 detail" data-id="'+data+'"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</button>';
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Komoditas";

        // aktifkan menu
        $("#master-data").addClass("show");
        $("#master-data-sub").addClass("show");
        $("#menu-komoditas").addClass("active");

        // panggil datatable
        table();

        // --- BEGIN : SUBSEKTOR ---
        // list select data pilih subsektor
        $.ajax({
            url: "api/retailers",
            type: "get",
            dataType: "json",
            success: function (data) {
                const subsektorSelect = $("#subsektor");

                subsektorSelect.append('<option value="">Pilih Subsektor</option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        subsektorSelect.append('<option value='+data[value].province_code+'>'+data[value].province+'</option>');
                    });
                }
            }
        })

        // apply filter subsektor
        $("#subsektor").change(function () {
            subsektor = $(this).val();
            table(subsektor);
        })
        // --- END : SUBSEKTOR ---
    });
</script>
@endsection
