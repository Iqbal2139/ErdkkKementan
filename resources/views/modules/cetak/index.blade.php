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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Pengajuan</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ '/ringkasan' }}" class="text-muted text-hover-primary">Ringkasan</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Pengajuan</li>
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
                        <select class="form-select form-select-solid" name="kelompok_tani" id="kelompok-tani" data-control="select2" data-placeholder="Pilih Kelompok Tani">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="subsectors" id="subsectors" data-control="select2" data-placeholder="Pilih Subsektor">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="commodities" id="commodities" data-control="select2" data-placeholder="Pilih Komoditas">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="kios" id="kios" data-control="select2" data-placeholder="Pilih Kios">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <button class="btn btn-success me-2 search" id="search">Search</button>
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
                            <th class="text-nowrap px-2">NIK</th>
                            <th class="text-nowrap px-2">Nama</th>
                            <th class="text-nowrap px-2">Kios/Pengecer</th>
                            <th class="text-nowrap px-2">Rencana Tanam(ha)</th>
                            <th class="text-nowrap px-2">Jumlah Urea</th>
                            <th class="text-nowrap px-2">Jumlah NPK</th>
                            <th class="text-nowrap px-2">Jumlah NPK Formula</th>
                            <th class="text-nowrap px-2">Jumlah Organic</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-start py-6 px-9">
                <button class="btn btn-primary me-2" id="downloadBtn">
                    <i class="ki-outline ki-send fs-3 me-1"></i>
                    Cetak Data
                </button>
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
@section('script')
<script>
    // declare param
    let kelurahan = '';
    let kelompokTani = '';
    let statusPengajuan = '';

    // list table data pengajuan
    let tableCetak = (poktan,subsectors,commodities,kios) => {
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
                url: 'api/cetak', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    poktan: poktan,
                    subsectors: subsectors,
                    commodities: commodities,
                    kios:kios
                }
            },
            columns: [
                {
                    data: 'farmer_nik',
                    name: 'farmer_nik'
                },
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
                },
                {
                    data: 'retailer_name',
                    name: 'retailer_name'
                },
                {
                    data: 'rencana_tanam',
                    name: 'rencana_tanam'
                },
                {
                    data: 'jml_urea',
                    name: 'jml_urea'
                },
                {
                    data: 'jml_npk',
                    name: 'jml_npk'
                },
                {
                    data: 'jml_npk_formula',
                    name: 'jml_npk_formula'
                },
                {
                    data: 'jml_organic',
                    name: 'jml_organic'
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Cetak Data";

        // aktifkan menu
        $("#menu-cetak").addClass("active");

        // panggil datatable
        tableCetak();

        $('#search').click(function() {
            var poktan = $('#kelompok-tani').val();
            var subsectors = $('#subsectors').val();
            var commodities = $('#commodities').val();
            var kios = $('#kios').val();
            tableCetak(poktan,subsectors,commodities,kios);
			return false;
        });

        $('#downloadBtn').click(function() {
            var poktan = $('#kelompok-tani').val();
            var subsectors = $('#subsectors').val();
            var commodities = $('#commodities').val();
            var kios = $('#kios').val();

            $.ajax({
                url: "api/cetak-pdf", // Your route to download the PDF
                method: 'GET',
                data: { poktan: poktan,
                        subsectors: subsectors,
                        commodities: commodities,
                        kios:kios
                },
                xhrFields: {
                    responseType: 'blob' // Important for downloading files
                },
                success: function(data) {
                    const blob = new Blob([data], { type: 'application/pdf' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'document.pdf'; // Default file name
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                },
                error: function() {
                    alert('An error occurred while downloading the PDF.');
                }
            });
        });

        // list select data pilih kelompok tani
        $.ajax({
            url: "api/farmer",
            type: "get",
            dataType: "json",
            success: function (data) {
                const kelompokTani = $("#kelompok-tani");

                kelompokTani.append('<option value="">Pilih Kelompok Tani</option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        kelompokTani.append('<option value='+data[value].id+'>'+data[value].name+'</option>');
                    });
                }
            }
        })

        // list select data pilih subsecktor
        $.ajax({
            url: "api/subsectors",
            type: "get",
            dataType: "json",
            success: function (data) {
                const kelompokTani = $("#subsectors");

                kelompokTani.append('<option value="">Pilih Subsektor</option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        kelompokTani.append('<option value='+data[value].name+'>'+data[value].name+'</option>');
                    });
                }
            }
        })

        // list select data pilih commodities
        $.ajax({
            url: "api/commodities",
            type: "get",
            dataType: "json",
            success: function (data) {
                const kelompokTani = $("#commodities");

                kelompokTani.append('<option value="">Pilih Komoditas/option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        kelompokTani.append('<option value='+data[value].name+'>'+data[value].name+'</option>');
                    });
                }
            }
        })

        // list select data pilih kios
        $.ajax({
            url: "api/kios",
            type: "get",
            dataType: "json",
            success: function (data) {
                const kelompokTani = $("#kios");

                kelompokTani.append('<option value="">Pilih Kios/option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        kelompokTani.append('<option value='+data[value].id+'>'+data[value].name+'</option>');
                    });
                }
            }
        })


      
    });
</script>
@endsection
