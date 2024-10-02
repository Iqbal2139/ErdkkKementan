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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Cari NIK</h1>
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
                    <li class="breadcrumb-item text-muted">Cari NIK</li>
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
            <div class="row">
                <div class="col-12">
                    <div class="p-9 pb-0 fs-6 fw-semibold text-gray-500">Untuk menampilkan data, harap pilih terlebih dahulu</div>
                </div>
            </div>
            <div class="card-header border-0 pt-0">
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid gap-5">
                    <div class="w-100 mw-250px">
                        <input type="text" class="form-control form-control-solid mb-lg-0" id="nik" placeholder="Masukkan NIK">
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" id="tahun" data-control="select2" data-placeholder="Pilih Tahun">
                            <option></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <button type="button" class="btn btn-primary" id="search">
                            <i class="ki-outline ki-close-circle fs-2"></i>Tampilkan Data</button>
                    </div>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
        </div>
        <div class="d-none" id="hasil-cari">
            @include('modules.cariNik.dataErdkk')
            @include('modules.cariNik.penebusanBulan')
            @include('modules.cariNik.penebusanTpubers')
            @include('modules.cariNik.penolakanTpubers')
            @include('modules.cariNik.sisa')
            @include('modules.cariNik.penebusanKt')
            @include('modules.cariNik.penolakanKt')
            @include('modules.cariNik.dataLog')
        </div>
        <div class="d-none" id="detail-erdkk">
            @include('modules.cariNik.detailErdkk')
        </div>
    </div>
    <!--end::Content container-->
</div>
@endsection
@section('script')
<script>
    // declare param
    let nik = '';
    let tahun = "";

    let table = (nik, tahun) => {
        return $('#data-erdkk').DataTable({
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
                url: 'api/data-erdkk-get', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    nik: nik,
                    tahun: tahun
                }
            },
            columns: [
                {
                    data: 'farmer_nik',
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-primary btn-sm mx-1" onclick="detail()">' +
                            '<i class="ki-outline ki-info fs-3 me-1"></i>'+data+'</button>';
                    }
                },
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
                },
                {
                    data: 'urea',
                    name: 'urea'
                },
                {
                    data: 'npk',
                    name: 'npk'
                },
                {
                    data: 'za',
                    name: 'za'
                },
                {
                    data: 'sp36',
                    name: 'sp36'
                },
                {
                    data: 'organic',
                    name: 'organic'
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
                {
                    data: 'baris',
                    name: 'baris'
                }
            ]
        });
    }

    let table2 = () => {
        return $('#penebusan-bulan').DataTable({
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
                    data: 'nama_status',
                    name: 'nama_status'
                },
                {
                    data: 'status_count',
                    name: 'status_count'
                }
            ]
        });
    }

    let table3 = () => {
        return $('#penebusan-tpubers').DataTable({
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
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'jumnik',
                    name: 'jumnik'
                }
            ]
        });
    }

    let table4 = () => {
        return $('#penolakan-tpubers').DataTable({
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
                    data: 'jumnik',
                    name: 'jumnik'
                }
            ]
        });
    }

    let table5 = () => {
        return $('#sisa').DataTable({
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
                }
            ]
        });
    }

    let table6 = () => {
        return $('#penebusan-kt').DataTable({
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
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'jumnik',
                    name: 'jumnik'
                },
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
                }
            ]
        });
    }

    let table7 = () => {
        return $('#penolakan-kt').DataTable({
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
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'jumnik',
                    name: 'jumnik'
                },
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
                }
            ]
        });
    }

    let table8 = () => {
        return $('#data-log').DataTable({
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
                    data: 'status_count',
                    name: 'status_count'
                },
                {
                    data: 'jumnik',
                    name: 'jumnik'
                },
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
                }
            ]
        });
    }

    let tableDetailErdkk = (nik, tahun) => {
        return $('#data-detail-erdkk').DataTable({
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
                url: 'api/detail-erdkk-get', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    nik: nik,
                    tahun: tahun
                }
            },
            columns: [
                {
                    data: 'ss_id',
                    name: 'ss_id'
                },
                {
                    data: 'penyuluh',
                    name: 'penyuluh'
                },
                {
                    data: 'farmer_nik',
                    name: 'farmer_nik'
                },
                {
                    data: 'pihc_code',
                    name: 'pihc_code'
                },
                {
                    data: 'nama_kios',
                    name: 'nama_kios'
                },
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
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
                {
                    data: 'poktan',
                    name: 'poktan'
                },
                {
                    data: 'ss_status',
                    name: 'ss_status'
                },
                {
                    data: 'planting_area',
                    name: 'planting_area'
                },
                {
                    data: 'komoditas',
                    name: 'komoditas'
                },
                {
                    data: 'urea',
                    name: 'urea'
                },
                {
                    data: 'npk',
                    name: 'npk'
                },
                {
                    data: 'sp36',
                    name: 'sp36'
                },
                {
                    data: 'za',
                    name: 'za'
                },
                {
                    data: 'organic',
                    name: 'organic'
                },
                {
                    data: 'npk_formula',
                    name: 'npk_formula'
                },
                {
                    data: 'poc',
                    name: 'poc'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                }
            ]
        });
    }

    $(document).ready(function() {
        document.getElementById("page-title").textContent="e-RDKK - Cari NIK";

        $("#menu-cari-nik").addClass("active");

        $("#search").on("click", function() {
            nik = $("#nik").val();
            tahun = $("#tahun").val();

            table(nik, tahun);
            table2(nik, tahun);
            table3(nik, tahun);
            table4(nik, tahun);
            table5(nik, tahun);
            table6(nik, tahun);
            table7(nik, tahun);
            table8(nik, tahun);

            $("#hasil-cari").removeClass("d-none");
        })

        $("#kembali").on('click', function() {
            $("#hasil-cari").removeClass("d-none");
            $("#detail-erdkk").addClass("d-none");
        })
    });

    function detail() {
        Swal.fire({
            title: "Lihat usulan yang dimaksud?",
            // text: "You won't be able to revert this!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "btn-primary",
            cancelButtonColor: "btn-light",
            confirmButtonText: "Ya, lihat data",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                tableDetailErdkk(nik, tahun);

                $("#hasil-cari").addClass("d-none");
                $("#detail-erdkk").removeClass("d-none");
            }
        });
    }
</script>
@endsection
