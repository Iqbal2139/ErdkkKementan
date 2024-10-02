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
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Data Log Hapus</h1>
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
                    <li class="breadcrumb-item text-muted">Data Log Hapus</li>
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
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="province_code" id="update_province_code" data-control="select2" data-placeholder="Pilih Provinsi">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="city_code" id="update_city_code" data-control="select2" data-placeholder="Pilih Kota / Kabupaten">
                            <option></option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-250px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="district_code" id="select_district_code" data-control="select2" data-placeholder="Pilih Kecamatan">
                            <option></option>
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
            <!--begin::Card body-->
            <div class="card-body py-4">
                <div class="d-flex justify-content-start">
                    <button class="btn btn-info px-6 d-none" id="download-excel-1">
                        <i class="ki-outline ki-cloud-download fs-3 me-1"></i>
                        Download Excel
                    </button>
                </div>
                <!--begin::Table-->
                <table id="example" class="table table-rounded table-striped border gy-5 gs-5 w-100 d-none">
                    <thead>
                        <tr class="fw-bold">
                            <th class="text-nowrap px-2">NAMA PENYULUH</th>
                            <th class="text-nowrap px-2">KTP</th>
                            <th class="text-nowrap px-2">NAMA IBU</th>
                            <th class="text-nowrap px-2">KODE DESA</th>
                            <th class="text-nowrap px-2">ID POKTAN</th>
                            <th class="text-nowrap px-2">KODE KIOS PENGECER</th>
                            <th class="text-nowrap px-2">SUBSEKTOR</th>
                            <th class="text-nowrap px-2">KOMODITAS MT1</th>
                            <th class="text-nowrap px-2">LAHAN MT1</th>
                            <th class="text-nowrap px-2">UREA MT1</th>
                            <th class="text-nowrap px-2">NPK MT1</th>
                            <th class="text-nowrap px-2">NPK FORMULA MT1</th>
                            <th class="text-nowrap px-2">KOMODITAS MT2</th>
                            <th class="text-nowrap px-2">LAHAN MT2</th>
                            <th class="text-nowrap px-2">UREA MT2</th>
                            <th class="text-nowrap px-2">NPK MT2</th>
                            <th class="text-nowrap px-2">NPK FORMULA MT2</th>
                            <th class="text-nowrap px-2">KOMODITAS MT3</th>
                            <th class="text-nowrap px-2">LAHAN MT3</th>
                            <th class="text-nowrap px-2">UREA MT3</th>
                            <th class="text-nowrap px-2">NPK MT3</th>
                            <th class="text-nowrap px-2">NPK FORMULA MT3</th>
                            <th class="text-nowrap px-2">UPLOAD</th>
                            <th class="text-nowrap px-2">DELETE</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle"></tbody>
                </table>
                <!--end::Table-->
                <div class="d-flex justify-content-start">
                    <button class="btn btn-info px-6" id="download-excel-2">
                        <i class="ki-outline ki-cloud-download fs-3 me-1"></i>
                        Download Excel
                    </button>
                </div>
                <!--begin::Table-->
                <table id="example2" class="table table-rounded table-striped border gy-5 gs-5 w-100">
                    <thead>
                        <tr class="fw-bold">
                            <th class="text-nowrap px-2">PROVINSI</th>
                            <th class="text-nowrap px-2">KABUPATEN</th>
                            <th class="text-nowrap px-2">KECAMATAN</th>
                            <th class="text-nowrap px-2">KELURAHAN</th>
                            <th class="text-nowrap px-2">KODE DESA</th>
                            <th class="text-nowrap px-2">NAMA POKTAN</th>
                            <th class="text-nowrap px-2">NAMA KIOS</th>
                            <th class="text-nowrap px-2">PIHC KODE</th>
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
<script src="{{ asset('js/custom/apps/wilayah/list/form.js') }}"></script>
<script>
    // declare param
    let district_code = '';
    let city_code = "";
    let province_code = "";
    let cachedDistricts = {};
    let cachedCities = {};

    let table = (province_code, city_code, district_code) => {
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
            ]
        });
    }

    let table2 = () => {
        return $('#example2').DataTable({
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
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'province',
                    name: 'province'
                },
            ]
        });
    }

    $(document).ready(function() {
        document.getElementById("page-title").textContent="e-RDKK - Data Log Hapus";

        $("#menu-data-log-hapus").addClass("active");

        initSelect2();
        loadInitialFilters();
        table2();

        $("#update_province_code").on("change", function() {
            province_code = $(this).val();
            city_code = '';
            district_code = '';

            $("#update_city_code").val(null).trigger('change');
            $("#select_district_code").val(null).trigger('change');

            if (province_code) {
                selectCity(province_code, 'update_city_code');
            } else {
                loadInitialFilters();
            }
        });

        $("#update_city_code").on("change", function() {
            city_code = $(this).val();
            district_code = '';

            $("#select_district_code").val(null).trigger('change');

            if (city_code) {
                selectDistrict(city_code, 'select_district_code');
            }
        });

        $("#select_district_code").on("change", function() {
            district_code = $(this).val();
        });

        $("#search").on("click", function() {
            $("#example").removeClass("d-none");
            $("#download-excel-1").removeClass("d-none");
            table(province_code, city_code, district_code);
        })

        $("#download-excel-1").click(function () {
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

        $("#download-excel-2").click(function () {
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
</script>
@endsection
