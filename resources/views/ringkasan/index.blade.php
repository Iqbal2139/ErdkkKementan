@extends('layouts.app')
@section('content')
<div id="content-ringkasan" class="d-block">
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
                    <table id="example" class="table table-rounded table-striped border gy-1 gs-2 w-100">
                        <thead>
                            <tr class="fw-bold">
                                <th class="text-nowrap px-2">Status</th>
                                <th class="text-nowrap px-2">Jumlah Baris</th>
                                <th class="text-nowrap px-2">Jumlah NIK</th>
                                <th class="text-nowrap px-2">Aksi</th>
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
    <!--end::Content-->
</div>

<div id="content-ringkasan-detail" class="d-none">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Ringkasan Detail</h1>
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
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                        <h2 class="fw-bold my-2">Data Berdasarkan Status :
                            <span class="fs-3 text-gray-400 fw-semibold ms-1" id="status_value"></span>
                            <input type="hidden" name="id_status" id="id_status" value="">
                        </h2>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Toolbar-->
                    <div class="justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Add user-->
                        <button type="button" class="btn btn-primary" id="back-to-ringkasan">
                        <i class="ki-outline ki-back fs-2"></i>Kembali</button>
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table id="example-detail" class="table table-rounded table-striped border gy-1 gs-2 w-100">
                        <thead class="align-middle">
                            <tr class="fw-bold">
                                <th class="text-nowrap px-2" rowspan="2">No.</th>
                                <th class="text-nowrap px-2" rowspan="2">Kecamatan</th>
                                <th class="text-nowrap px-2" rowspan="2">Total Baris</th>
                                <th class="text-nowrap px-2" rowspan="2">Total NIK</th>
                                <th class="text-nowrap px-2" rowspan="2">Total Rencana Tanam</th>
                                <th class="text-nowrap px-2">Urea</th>
                                <th class="text-nowrap px-2">NPK</th>
                                <th class="text-nowrap px-2">NPK Formula</th>
                                <th class="text-nowrap px-2">Organik</th>
                            </tr>
                            <tr class="fw-bold">
                                <th class="text-nowrap px-2" id="ket-urea">Total Input (Kg)</th>
                                <th class="text-nowrap px-2" id="ket-npk">Total Input (Kg)</th>
                                <th class="text-nowrap px-2" id="ket-npk-formula">Total Input (Kg)</th>
                                <th class="text-nowrap px-2" id="ket-organik">Total Input (Kg)</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle"></tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
                <div class="card-footer d-flex justify-content-start py-6 px-9">
                <button class="btn btn-info px-6" id="downloadExcel">
                    <i class="ki-outline ki-cloud-download fs-3 me-1"></i>
                    Download Excel
                </button>
            </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
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
            paginate: false,
            pageLength: 25,
            // lengthMenu: [5, 10, 25, 50, "All"],
            "searching": false,
            info: false,
            ordering: false,
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
                url: 'api/ringkasan', // memanggil route yang menampilkan data json
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
                    data: 'jumnik',
                    name: 'jumnik'
                },
                {
                    data: 'id_status',
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-success btn-sm mx-1 detail" onclick="detail('+data+')"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</button>';
                      //  return '<a href="/ringkasan/'+data+'" class="btn btn-success btn-sm mx-1 detail"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</a>';
                    }
                }
            ]
        });
    }

    // list table data pengajuan
    let tableDetail = (id) => {
        return $('#example-detail').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            paginate: false,
            ordering: false,
            // pageLength: 25,
            // lengthMenu: [5, 10, 25, 50, "All"],
            "searching": false,
            info: false,
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
                url: 'api/ringkasan-detail', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                     id: id
                }
            },
            // columnDefs: [
            //     { targets: 0, width: '20px', orderable: false },
            //     { targets: 1, width: '300px' },
            //     { targets: 2, width: '100px' },
            //     { targets: 3, width: '100px' },
            //     { targets: 4, width: '100px' },
            //     { targets: 5, width: '100px' },
            //     { targets: 6, width: '100px' },
            //     { targets: 7, width: '100px' },
            // ],
            columns: [
                {
                    // Row number column
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Calculate row number
                    }
                },
                {
                    data: 'district',
                    name: 'district'
                },
                {
                    data: 'jum_baris',
                    name: 'jum_baris'
                },
                {
                    data: 'jumnik',
                    name: 'jumnik'
                },
                {
                    data: 'rencana_tanam',
                    name: 'rencana_tanam'
                },
                {
                    data: 'jum_urea',
                    name: 'jum_urea'
                },
                {
                    data: 'jum_npk',
                    name: 'jum_npk'
                },
                {
                    data: 'jum_npk_formula',
                    name: 'jum_npk_formula'
                },
                {
                    data: 'jum_organic',
                    name: 'jum_organic'
                }
            ]
        });
    }

    function detail(id) {
         $.ajax({
             url: "api/ringkasan-status",
             type: "get",
             data: {
                 id: id
             },
             dataType: "json",
             success: function(response) {
                if (response.length > 0) {
                    var status = response[0];
                    $('#status_value').text(status.name);
                    $('#id_status').val(id);

                    tableDetail(id);
                    $("#content-ringkasan").removeClass('d-block');
                    $("#content-ringkasan").addClass('d-none');

                    $("#content-ringkasan-detail").removeClass('d-none');
                    $("#content-ringkasan-detail").addClass('d-block');
                } else {
                    console.log('No status found.');
                }


             },
             error: function(xhr) {
                 // Handle error
                 console.log(xhr.responseText);
             }
        })
    }

    $('#downloadExcel').on('click', function() {
        var id_status = $('#id_status').val();
        $.ajax({
            url: 'api/download-ringkasan', // The endpoint to send the request to
            type: 'POST',
            data: {
                id_status: id_status,
                _token: '{{ csrf_token() }}' // CSRF token for security
            },
            xhrFields: {
                responseType: 'blob' // Important to handle file download
            },
            success: function(data, status, xhr) {
                var filename = ""; // Set filename for download
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var regex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = regex.exec(disposition);
                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, '');
                    }
                }
                var blob = new Blob([data]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename ? filename : 'data.xlsx'; // Default filename
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr) {
                console.error('Error occurred:', xhr);
            }
        });
    });

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Ringkasan";

        // aktifkan menu
        $("#menu-ringkasan").addClass("active");

        // panggil datatable
        table();

        $("#back-to-ringkasan").on("click", function() {
            $("#content-ringkasan").removeClass('d-none');
            $("#content-ringkasan").addClass('d-block');

            $("#content-ringkasan-detail").removeClass('d-block');
            $("#content-ringkasan-detail").addClass('d-none');
            table();
        })
    });
</script>
@endsection
