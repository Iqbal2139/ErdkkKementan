@extends('layouts.app')
@section('content')
<style>
    .select2-container {
        z-index: 9999 !important; /* Pastikan dropdown selalu di atas modal */
    }

</style>
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">User</h1>
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
                    <li class="breadcrumb-item text-muted">User</li>
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
                        {{-- <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" /> --}}
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Toolbar-->
                <div class="justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_user" id="add_user_button">
                    <i class="ki-outline ki-plus fs-2"></i>Add User</button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table id="example" class="table table-rounded table-striped border gy-5 gs-5 w-100">
                    <thead>
                        <tr class="fw-bold">
                            <th class="text-nowrap px-2">USERNAME</th>
                            <th class="text-nowrap px-2">NAMA</th>
                            <th class="text-nowrap px-2">PROVINSI</th>
                            <th class="text-nowrap px-2">KOTA</th>
                            <th class="text-nowrap px-2">KABUPATEN</th>
                            <th class="text-nowrap px-2">ROLE</th>
                            <th class="text-nowrap px-2">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                    </tbody>
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
<!--begin::Modal - Add user-->
<div class="modal fade" id="modal_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="modal_user_form" class="form" action="#">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_user_header" data-kt-scroll-wrappers="#modal_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-name">Nama Pengguna</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="255" placeholder="Nama Pengguna" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-username">Username</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="username" id="username" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="80" placeholder="Username" required/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="row-password">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-password">Password</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="password" name="password" id="password" class="form-control form-control-solid mb-3 mb-lg-0" maxlength="40" placeholder="Password"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-role-id">Peran Pengguna</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" name="role_id" id="role_id" data-control="select2" data-placeholder="Pilih Peran Pengguna" required>
                                <option></option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-province-code">Provinsi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" name="province_code" id="province_code" data-control="select2" data-placeholder="Pilih Provinsi" required>
                                <option></option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-city-code">Kota/Kabupaten</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" name="city_code" id="city_code" data-control="select2" data-placeholder="Pilih Kota/Kabupaten" required>
                                <option></option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2" id="label-district-code">Kecamatan</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" name="district_code" id="district_code" data-control="select2" data-placeholder="Pilih Kecamatan" required>
                                <option></option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10" id="action-form">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
<!--end::Modal - Add user-->
@endsection
@section('script')
<script src="{{ asset('js/custom/apps/user-management/users/list/form.js') }}"></script>
<script>
    let role_id = '';
    let province_code = '';
    let city_code = '';
    let district_code = '';
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
            "searching": true,
            ajax: {
                url: 'api/user', // memanggil route yang menampilkan data json
                method: 'get'
            },
            columns: [
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'name',
                    name: 'name'
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
                    data: 'roleName',
                    name: 'roleName'
                },
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-danger btn-sm mx-1" onclick="resetPass('+data+')"><i class="ki-outline ki-arrow-circle-right fs-3 me-1"></i>Reset Password</button>'+
                        '<button class="btn btn-warning btn-sm mx-1" onclick="handleUpdateClick('+data+')"><i class="ki-outline ki-notepad-edit fs-3 me-1"></i>Update</button>'+
                        '<button class="btn btn-success btn-sm mx-1" onclick="handleDetailClick('+data+')"><i class="ki-outline ki-information-5 fs-3 me-1"></i>Detail</button>';
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        // page title
        document.getElementById("page-title").textContent="e-RDKK - User";

        // aktifkan menu
        $("#master-data").addClass("show");
        $("#master-data-sub").addClass("show");
        $("#menu-user").addClass("active");

        // panggil datatable
        table();
        initSelect2();
        loadselect2();

        $('#role_id').select2({
            dropdownParent: $('#modal_user')
        });

        $('#province_code').select2({
            dropdownParent: $('#modal_user')
        });

        $('#city_code').select2({
            dropdownParent: $('#modal_user')
        });

        $('#district_code').select2({
            dropdownParent: $('#modal_user')
        });

        $("#province_code").on("change", function() {
            province_code = $(this).val();
            city_code = '';
            selectCity(selectCity, 'city_code', 'district_code');
        })

        $("#city_code").on("change", function() {
            city_code = $(this).val();
            district_code = '';
            selectDistrict(district_code, 'district_code');
        })
    });

    function initSelect2() {
        $("#role_id").select2({
            placeholder: 'Pilih Provinsi',
            allowClear: true
        });
        $("#province_code").select2({
            placeholder: 'Pilih Provinsi',
            allowClear: true
        });
        $("#city_code").select2({
            placeholder: 'Pilih Kota/Kabupaten',
            allowClear: true
        });
        $("#district_code").select2({
            placeholder: 'Pilih Kecamatan',
            allowClear: true
        });
    }

    function loadselect2() {
        $.ajax({
            url: "api/role-get",
            type: "get",
            dataType: "json",
            success: function (res) {
                const role_id = $("#role_id");
                role_id.empty();
                role_id.append('<option value="">Pilih Provinsi</option>');
                if (res.status == 200) {
                    res.data.forEach((item) => {
                        role_id.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                }
            }
        });

        $.ajax({
            url: "api/areas-province",
            type: "get",
            dataType: "json",
            success: function (res) {
                const province = $("#province_code");
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
                const city = $("#city_code");
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
                const district = $("#district_code");
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

    // action reset pass
    function resetPass(id) {
        console.log(id);
        Swal.fire({
            title: "Apakah Anda yakin reset password?",
            // text: "You won't be able to revert this!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, reset password"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "api/reset-pass",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            table();
                            Swal.fire({
                                title: "Sukses",
                                text: "Reset password berhasil.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal",
                                text: "Reset password gagal.",
                                icon: "error"
                            });
                        }
                    }
                })
            }
        });
    }

    function selectRole(role_id, select_role_id) {
        $.ajax({
            url: "api/role-get",
            type: "get",
            dataType: "json",
            success: function (res) {
                const role = $("#"+select_role_id);

                role.append('<option value="">Pilih Peran Pengguna</option>');
                if (res.status == 200) {
                    var data = res.data;

                    data.forEach((key, value) => {
                        var selected = (role_id !== '' && data[value].id == role_id) ? 'selected' : '';
                        role.append('<option value='+data[value].id+' '+selected+'>'+data[value].name+'</option>');
                    });
                }
            }
        })
    }

    function selectProvince(province_code, select_province_code) {
        $.ajax({
            url: "api/areas-province",
            type: "get",
            dataType: "json",
            success: function (res) {
                const province = $("#"+select_province_code);

                province.append('<option value="">Pilih Provinsi</option>');
                if (res.status == 200) {
                    var data = res.data;

                    data.forEach((key, value) => {
                        var selected = (province_code !== '' && data[value].province_code == province_code) ? 'selected' : '';
                        province.append('<option value='+data[value].province_code+' '+selected+'>'+data[value].province+'</option>');
                    });
                }
            }
        })
    }

    function selectCity(city_code, select_city_code, select_district_code) {
        $.ajax({
            url: "api/areas-city",
            type: "get",
            data: {
                province_code: province_code
            },
            dataType: "json",
            success: function (res) {
                const district = $("#"+select_district_code);

                district.empty();

                const city = $("#"+select_city_code);

                city.empty();

                city.append('<option value="">Pilih Kota/Kabupaten</option>');
                if (res.status == 200) {
                    var data = res.data;

                    data.forEach((key, value) => {
                        var selected = (city_code !== '' && data[value].city_code == city_code) ? 'selected' : '';
                        city.append('<option value='+data[value].city_code+' '+selected+'>'+data[value].city+'</option>');
                    });
                }
            }
        })
    }

    function selectDistrict(district_code, select_district_code) {
        $.ajax({
            url: "api/areas-district",
            type: "get",
            data: {
                province_code: province_code,
                city_code: city_code
            },
            dataType: "json",
            success: function (res) {
                const district = $("#"+select_district_code);

                district.empty();

                district.append('<option value="">Pilih Kota/Kabupaten</option>');
                if (res.status == 200) {
                    var data = res.data;

                    data.forEach((key, value) => {
                        var selected = (district_code !== '' && data[value].district_code == district_code) ? 'selected' : '';
                        district.append('<option value='+data[value].district_code+' '+selected+'>'+data[value].district+'</option>');
                    });
                }
            }
        })
    }
</script>
@endsection
