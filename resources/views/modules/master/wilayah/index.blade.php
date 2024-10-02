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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Wilayah</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ '/ringkasan' }}" class="text-muted text-hover-primary">Master Data</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Wilayah</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-4 w-100 justify-content-end" data-kt-wilayah-table-toolbar="base">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_wilayah" id="add_wilayah_button">
            <i class="ki-outline ki-plus fs-2"></i>Add Wilayah</button>
        </div>
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
                        <select class="form-select form-select-solid" name="province_code" id="update_province_code" data-control="select2" data-placeholder="Pilih provinsi">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="city_code" id="update_city_code" data-control="select2" data-placeholder="Pilih kota / kabupaten">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="district_code" id="select_district_code" data-control="select2" data-placeholder="Pilih kecamatan">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <button type="button" class="btn btn-warning" id="clear_filter_button">
                            <i class="ki-outline ki-close-circle fs-2"></i>Clear Filter</button>
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
                            <th class="text-nowrap px-2">KELURAHAN</th>
                            <th class="text-nowrap px-2">KECAMATAN</th>
                            <th class="text-nowrap px-2">KOTA</th>
                            <th class="text-nowrap px-2">PROVINSI</th>
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
            {{-- <div class="card-footer d-flex justify-content-start py-6 px-9">
                <button class="btn btn-primary me-2" id="kirim-semua">
                    <i class="ki-outline ki-send fs-3 me-1"></i>
                    Kirim Semua
                </button>
                <button class="btn btn-info px-6" id="download-excel">
                    <i class="ki-outline ki-cloud-download fs-3 me-1"></i>
                    Download Excel
                </button>
            </div> --}}
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>

<div class="modal fade" id="modal_wilayah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_wilayah_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Wilayah</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-wilayahs-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="modal_wilayah_form" class="form" action="#">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_wilayah_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_wilayah_header" data-kt-scroll-wrappers="#modal_wilayah_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-thn">Tahun</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="thn" id="thn" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tahun" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-sub-district-code">Kode Kelurahan / Sub Dictrict Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="sub_district_code" id="sub_district_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="10" placeholder="Kode Kelurahan / Sub Dictrict Code" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-sub-district">Kelurahan / Sub District</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="sub_district" id="sub_district" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="255" placeholder="Kelurahan / Sub District" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-district-code">Kode Kecamatan / District Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="district_code" id="district_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="6" placeholder="Kode Kecamatan / Dictrict Code" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-district">Kecamatan / District</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="district" id="district" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="255" placeholder="Kecamatan / District" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-city-code">Kode Kabupaten atau Kota / City Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="city_code" id="city_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="4" placeholder="Kode Kabupaten atau Kota / City Code" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-city">Kabupaten atau Kota / City</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="255" placeholder="Kabupaten atau Kota / City" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-province-code">Kode Provinsi / Province Code</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="province_code" id="province_code" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="2" placeholder="Kode Provinsi / Province Code" required/>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-province">Provinsi / Province</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="province" id="province" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="255" placeholder="Provinsi / Province" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-wilayahs-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-wilayahs-modal-action="submit">
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
<script src="{{ asset('js/custom/apps/wilayah/list/form.js') }}"></script>
<script>
// declare param
let district_code = '';
let city_code = "";
let province_code = "";
let cachedDistricts = {};
let cachedCities = {};

let tableWilayah = (province_code, city_code, district_code) => {
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
            url: 'api/wilayah',
            method: 'get',
            data: {
                district_code: district_code,
                city_code: city_code,
                province_code: province_code,
            }
        },
        columns: [
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
    document.getElementById("page-title").textContent="e-RDKK - Wilayah";

    $("#master-data").addClass("show");
    $("#master-data-sub").addClass("show");
    $("#menu-wilayah").addClass("active");

    initSelect2();
    tableWilayah();
    loadInitialFilters();

    $("#update_province_code").on("change", function() {
        province_code = $(this).val();
        city_code = '';
        district_code = '';

        $("#update_city_code").val(null).trigger('change');
        $("#select_district_code").val(null).trigger('change');

        if (province_code) {
            selectCity(province_code, 'update_city_code');
            selectDistrictByProvince(province_code, 'select_district_code');

        } else {
            loadInitialFilters();
        }

        tableWilayah(province_code, '', '');
    });

    $("#update_city_code").on("change", function() {
        city_code = $(this).val();
        district_code = '';

        $("#select_district_code").val(null).trigger('change');

        if (city_code) {
            selectDistrict(city_code, 'select_district_code');
        }

        tableWilayah(province_code, city_code, '');
    });


    $("#select_district_code").on("change", function() {
        district_code = $(this).val();
        tableWilayah(province_code, city_code, district_code);
    });

    $('#clear_filter_button').on('click', function () {
        resetFilters();
    });
});

function loadInitialFilters() {
    $.ajax({
        url: "api/areas-province",
        type: "get",
        dataType: "json",
        success: function (res) {
            const province = $("#update_province_code");
            province.empty();
            province.append('<option value="">Pilih Provinsi</option>');
            if (res.status == 200) {
                res.data.forEach((item) => {
                    province.append('<option value="' + item.province_code + '">' + item.province + '</option>');
                });
            }
        }
    });

    $.ajax({
        url: "api/areas-city",
        type: "get",
        dataType: "json",
        success: function (res) {
            const city = $("#update_city_code");
            city.empty();
            city.append('<option value="">Pilih Kota/Kabupaten</option>');
            if (res.status == 200) {
                res.data.forEach((item) => {
                    city.append('<option value="' + item.city_code + '">' + item.city + '</option>');
                });
            }
        }
    });

    $.ajax({
        url: "api/areas-district",
        type: "get",
        dataType: "json",
        success: function (res) {
            const district = $("#select_district_code");
            district.empty();
            district.append('<option value="">Pilih Kecamatan</option>');
            if (res.status == 200) {
                res.data.forEach((item) => {
                    district.append('<option value="' + item.district_code + '">' + item.district + '</option>');
                });
            }
        }
    });
}


function initSelect2() {
    $("#update_province_code").select2({
        placeholder: 'Pilih Provinsi',
        allowClear: true
    });
    $("#update_city_code").select2({
        placeholder: 'Pilih Kota/Kabupaten',
        allowClear: true
    });
    $("#select_district_code").select2({
        placeholder: 'Pilih Kecamatan',
        allowClear: true
    });
}
function selectCity(province_code, select_city_code) {
    if (cachedCities[province_code]) {
        populateCitySelect(cachedCities[province_code]);
    } else {
        $.ajax({
            url: "api/areas-city",
            type: "get",
            data: { province_code: province_code },
            dataType: "json",
            success: function (res) {
                cachedCities[province_code] = res.data;
                populateCitySelect(res.data);
            }
        });
    }
}

function selectDistrict(city_code, select_district_code) {
    $.ajax({
        url: "api/areas-district",
        type: "get",
        data: { city_code: city_code },
        dataType: "json",
        success: function (res) {
            const district = $("#" + select_district_code);
            district.empty();
            district.append('<option value="">Pilih Kecamatan</option>');

            if (res.status == 200) {
                cachedDistricts[city_code] = res.data;
                populateDistrictSelect(res.data);
            }
        }
    });
}

function selectDistrictByProvince(province_code, select_district_code) {
    $.ajax({
        url: "api/areas-district",
        type: "get",
        data: { province_code: province_code },
        dataType: "json",
        success: function (res) {
            const district = $("#" + select_district_code);
            district.empty();
            district.append('<option value="">Pilih Kecamatan</option>');

            if (res.status == 200) {
                cachedDistricts[province_code] = res.data;
                populateDistrictSelect(res.data);
            }
        }
    });
}

function populateCitySelect(cities) {
    const city = $("#update_city_code");
    city.empty();
    city.append('<option value="">Pilih Kota/Kabupaten</option>');
    cities.forEach((item) => {
        city.append('<option value="' + item.city_code + '">' + item.city + '</option>');
    });
}

function populateDistrictSelect(districts) {
    const district = $("#select_district_code");
    district.empty();
    district.append('<option value="">Pilih Kecamatan</option>');
    districts.forEach((item) => {
        district.append('<option value=' + item.district_code + '>' + item.district + '</option>');
    });
}

function resetFilters() {
    province_code = '';
    city_code = '';
    district_code = '';

    $("#update_province_code").val(null).trigger('change');
    $("#update_city_code").val(null).trigger('change');
    $("#select_district_code").val(null).trigger('change');

    tableWilayah();
}

</script>
@endsection
