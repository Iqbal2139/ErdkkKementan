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
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">
                    <i class="ki-outline ki-cloud-add fs-3 me-1"></i>
                    Input Usulan e-RDKK (Upload CSV)
                </a>
            </div>
            <!--end::Actions-->
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
                        <select class="form-select form-select-solid" name="kelurahan" id="kelurahan" data-control="select2" data-placeholder="Pilih Kelurahan">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="kelompok_tani" id="kelompok-tani" data-control="select2" data-placeholder="Pilih Kelompok Tani">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="status_pengajuan" id="status-pengajuan" data-control="select2" data-placeholder="Pilih Status Pengajuan">
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
                            <th class="text-nowrap px-2">NAMA PETANI</th>
                            <th class="text-nowrap px-2">KTP</th>
                            <th class="text-nowrap px-2">KODE DESA</th>
                            <th class="text-nowrap px-2">WAKTU DIBUAT</th>
                            <th class="text-nowrap px-2">WAKTU DIPERBAHARUI</th>
                            <th class="text-nowrap px-2">STATUS</th>
                            <th class="text-nowrap px-2">AKSI</th>
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
                <button class="btn btn-primary me-2" id="kirim-semua">
                    <i class="ki-outline ki-send fs-3 me-1"></i>
                    Kirim Semua
                </button>
                <button class="btn btn-info px-6" id="download-excel">
                    <i class="ki-outline ki-cloud-download fs-3 me-1"></i>
                    Download Excel
                </button>
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
<!--begin::Modal - Create Campaign-->
<div class="modal fade" id="kt_modal_create_campaign" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg p-9">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Tata Cara Upload Pengajuan e-RDKK</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_campaign_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav justify-content-center py-2">
                        <!--begin::Step 1-->
                        <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Download Template</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Input Data</h3>
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Upload CSV</h3>
                        </div>
                        <!--end::Step 3-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto w-100 mw-500px pt-15 pb-10" novalidate="novalidate" id="kt_modal_create_campaign_stepper_form" enctype="multipart/form-data" method="post">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bold d-flex align-items-center text-dark">Langkah 1: Download Template
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Campaign name will be used as reference within your campaign reports">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span></h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-semibold fs-6">unduh Template dengan cara klik url berikut
                                    <a href="#" class="link-primary fw-bold">data.xlsx</a></div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bold text-dark">Langkah 2: Upload Data</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="text-muted fw-semibold fs-4 text-justify overflow-auto mh-300px">
                                        Isi file template dengan data pengajuan Erdkk sesuai dengan ketentuan dari Admin Kementan Pusat sebagai berikut.

                                        <ol>
                                            <li>Kode Desa harus sesuai dengan data yang terdapat pada Master Data Wilayah.</li>
                                            <li>ID Poktan (Kelompok Tani) harus sesuai dengan data yang terdapat pada Master Data Kelompok Tani yang berasal dari SIMLUHTAN. Mohon upload/tambahkan data kelompok tani di SIMLUHTAN apabila tidak tersedia di master data.</li>
                                            <li>Subsektor dan komoditas harus sesuai dengan data yang terdapat pada Master Data Subsektor dan Master Data Komoditas.</li>
                                            <li>Nama Pengecer dan Kode Pengecer harus sesuai dengan data yang terdapat pada Master Data Pengecer.</li>
                                            <li>Nomor KTP harus 16 digit dan harus cocok dengan data yang ada di SIMLUHTAN. Mohon periksa kembali data nomor ktp di SIMLUHTAN apabila NIK tidak ditemukan.</li>
                                            <li>Luas tanam petani per tahun untuk setiap musim tanam maksimal 2 ha diutamakan 0,5 ha.</li>
                                            <li>Setelah selesai input data, mohon diperiksa kembali setiap isian. Tidak boleh ada tanda koma (,) dan petik dua(") pada setiap kolom data.</li>
                                            <li>Simpan file dengan format csv. Apabila Anda ingin mengupload file yang telah direvisi mohon hapus kolom revisi terlebih dahulu.</li>
                                        </ol>
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Heading-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bold text-dark">Langkah 3: Upload CSV</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    @csrf
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-10">
                            <!--begin::Wrapper-->
                            <div class="me-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                <i class="ki-outline ki-arrow-left fs-3 me-1"></i>Back</button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                    <span class="indicator-label">Submit
                                    <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i></span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                                <i class="ki-outline ki-arrow-right fs-3 ms-1 me-0"></i></button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Create Campaign-->
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
<script>
    // declare param
    let kelurahan = '';
    let kelompokTani = '';
    let statusPengajuan = '';

    // list table data pengajuan
    let tablePengajuan = (kelurahan, kelompokTani, statusPengajuan) => {
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
                url: 'api/pengajuan', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    kelurahan: kelurahan,
                    kelompokTani: kelompokTani,
                    statusPengajuan: statusPengajuan
                }
            },
            columns: [
                {
                    data: 'farmer_name',
                    name: 'farmer_name'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'sub_district_code',
                    name: 'sub_district_code'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'status.name',
                    name: 'status.name'
                },
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return'<button class="btn btn-success btn-sm detail" data-id="'+data+'"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Kirim</button><br><button class="btn btn-warning btn-sm detail" data-id="'+data+'"><i class="ki-outline ki-information-5 fs-3 me-1"></i>batal</button><br><button class="btn btn-danger btn-sm detail" data-id="'+data+'"><i class="ki-outline ki-information-5 fs-3 me-1"></i>hapus</button>';
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Pengajuan";

        // aktifkan menu
        $("#menu-pengajuan").addClass("active");

        // panggil datatable
        tablePengajuan();

        // --- BEGIN : KELURAHAN ---
        // list select data pilih kelurahan
        $(function(){
            $("#kelurahan").select2({
                // minimumInputLength: 2,
                ajax: {
                    url: 'api/areas',
                    dataType: 'json',
                    type: "get",
                    data: function (term) {
                        return {
                            search: term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
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

        // $.ajax({
        //     url: "api/areas",
        //     type: "get",
        //     dataType: "json",
        //     success: function (data) {
        //         const kelurahan = $("#kelurahan");

        //         kelurahan.append('<option value="">Pilih Kelurahan</option>')
        //         data.forEach((key, value) => {
        //             kelurahan.append('<option value='+data[value].sub_district_code+'>'+data[value].sub_district+'</option>');
        //         });
        //     }
        // })

        // apply filter kelurahan
        $("#kelurahan").change(function () {
            kelurahan = $(this).val();
            tablePengajuan(kelurahan, kelompokTani, statusPengajuan);
        })
        // --- END : KELURAHAN ---


        // --- BEGIN : KELOMPOK TANI ---
        // list select data pilih kelompok tani
        $.ajax({
            url: "api/retailers",
            type: "get",
            dataType: "json",
            success: function (data) {
                const kelompokTani = $("#kelompok-tani");

                kelompokTani.append('<option value="">Pilih Kelompok Tani</option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        kelompokTani.append('<option value='+data[value].province_code+'>'+data[value].province+'</option>');
                    });
                }
            }
        })

        // apply filter kelompok tani
        $("#kelompok-tani").change(function () {
            kelompokTani = $(this).val();
            tablePengajuan(kelurahan, kelompokTani, statusPengajuan);
        })
        // --- END : KELOMPOK TANI ---

        // --- BEGIN : STATUS PENGAJUAN ---
        // list select data status pengajuan
        $.ajax({
            url: "api/status",
            type: "get",
            dataType: "json",
            success: function (data) {
                const status = $("#status-pengajuan");

                status.append('<option value="">Pilih Status Pengajuan</option>');
                if (typeof(data.message) === 'undefined') {
                    data.forEach((key, value) => {
                        status.append('<option value='+data[value].id+'>'+data[value].name+'</option>');
                    });
                }
            }
        })

        // apply filter status pengajuan
        $("#status-pengajuan").change(function () {
            statusPengajuan = $(this).val();
            tablePengajuan(kelurahan, kelompokTani, statusPengajuan);
        })
        // --- END : STATUS PENGAJUAN ---

        // action kirim semua
        $("#kirim-semua").click(function () {
            Swal.fire({
                title: "Apakah Anda yakin kirim semua data?",
                // text: "You won't be able to revert this!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, kirim semua data"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/send-pengajuan",
                        type: "post",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Data berhasil dikirim.",
                                icon: "success"
                            });
                        }
                    })

                }
            });
        })

        // action download excel
        $("#download-excel").click(function () {
            $.ajax({
                url: "api/retailers",
                type: "get",
                dataType: "json",
                success: function (data) {
                    Swal.fire({
                        title: "Sukses",
                        text: "Berhasil download.",
                        icon: "success"
                    });
                }
            })
        })
    });
</script>
@endsection
