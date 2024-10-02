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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Ringkasan</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Ringkasan</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted"></li>
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
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table id="example" class="table table-rounded table-striped border gs-4 gy-1">
                    <thead style="height: 40px;line-height: 40px;">
                        <tr class="fw-bold">
                            <th class="text-nowrap px-2">Status</th>
                            <th class="text-nowrap px-2">Jumlah Baris</th>
                            <th class="text-nowrap px-2">Jumlah NIK</th>
                            <th class="text-nowrap px-2">Aksi</th>
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
    // list table data pengajuan
    let table = () => {
        return $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            paginate: true,
            pageLength: 25,
            lengthMenu: [5, 10, 25, 50, "All"],
            "searching": true,
            ajax: {
                url: 'api/ringkasan/detail', // memanggil route yang menampilkan data json
                method: 'get'
            },
            columns: [
                {
                    data: 'nama_status',
                    name: 'nama_status'
                },
                {
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'id_status',
                    render: function (data, type, row, meta) {
                      //  return '<button class="btn btn-success btn-sm mx-1 detail" data-id="'+data+'"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</button>';
                        return '<a href="/ringkasan/'+data+'" class="btn btn-success btn-sm mx-1 detail"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</a>';
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Ringkasan";

        // aktifkan menu
        $("#menu-ringkasan").addClass("active");

        // panggil datatable
        table();
    });
</script>
@endsection
