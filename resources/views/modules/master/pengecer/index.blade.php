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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Pengecer</h1>
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
                    <li class="breadcrumb-item text-muted">Pengecer</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>

        <div class="d-flex flex-stack flex-wrap gap-4 w-100 justify-content-end" data-kt-pengecer-table-toolbar="base">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_pengecer" id="add_pengecer_button">
            <i class="ki-outline ki-plus fs-2"></i>Add Pengecer</button>
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
                            <th class="text-nowrap px-2">KODE PIHC</th>
                            <th class="text-nowrap px-2">NAMA PENGECER</th>
                            <th class="text-nowrap px-2">KODE DESA</th>
                            <th class="text-nowrap px-2">KELURAHAN</th>
                            <th class="text-nowrap px-2">KECAMATAN</th>
                            <th class="text-nowrap px-2">KOTA</th>
                            <th class="text-nowrap px-2">PROVINSI</th>
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
<!--end::Content-->
<div class="modal fade" id="modal_pengecer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_pengecer_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Pengecer</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-pengecers-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="modal_pengecer_form" class="form" action="#">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_pengecer_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_pengecer_header" data-kt-scroll-wrappers="#modal_pengecer_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">PIHC Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="pihc_code" id="pihc_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="11" placeholder="PIHC Code" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-sub-district-code">Kode Kelurahan / Sub Dictrict Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="sub_district_code" id="sub_district_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="10" placeholder="Kode Kelurahan / Sub Dictrict Code" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Status</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1">
                                    <label class="form-check-label" for="option1">
                                        aktif
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active_2" value="2">
                                    <label class="form-check-label" for="option2">
                                        tidak aktif
                                    </label>
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-pengecers-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-pengecers-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection
@section('script')
<script src="{{ asset('js/custom/apps/pengecer/list/form.js') }}"></script>
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
                url: 'api/pengecer', // memanggil route yang menampilkan data json
                method: 'get',
                data: {
                    subdistrict: subdistrict
                }
            },
            columns: [
                {
                    data: 'pihc_code',
                    name: 'pihc_code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'sub_district_code',
                    name: 'sub_district_code'
                },
                {
                    data: 'sub_district',
                    name: 'sub_district'
                },
                {
                    data: 'district',
                    name: 'district'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-warning btn-sm mx-1 update-data" data-id="' + data + '" onclick="handleUpdateClick(' + data + ')">' +
                            '<i class="ki-outline ki-notepad-edit fs-3 me-1"></i>Update</button>';
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - Pengecer";

        // aktifkan menu
        $("#master-data").addClass("show");
        $("#master-data-sub").addClass("show");
        $("#menu-pengecer").addClass("active");

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
