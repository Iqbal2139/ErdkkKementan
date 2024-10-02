var KTModalUser = (function () {
    const t = document.getElementById("modal_user"),
        e = t.querySelector("#modal_user_form"),
        n = new bootstrap.Modal(t);
    let currentUserId = null;

    function setUserData(user, isReadOnly = false, title) {
        currentUserId = user.id;
        document.getElementById("name").value = user.name;
        document.getElementById("username").value = user.username;
        $('#role_id').val(user.role_id).trigger('change');
        $('#province_code').val(user.province_code).trigger('change');
        $('#city_code').val(user.city_code).trigger('change');
        $('#district_code').val(user.district_code).trigger('change');

        if (isReadOnly) {
            document.getElementById("name").setAttribute("readonly", "readonly");
            document.getElementById("username").setAttribute("readonly", "readonly");

            $('#role_id').prop('disabled', true).trigger('change');
            $('#province_code').prop('disabled', true).trigger('change');
            $('#city_code').prop('disabled', true).trigger('change');
            $('#district_code').prop('disabled', true).trigger('change');

            toggleRequiredClass(false);
        } else {
            document.getElementById("name").removeAttribute("readonly", "readonly");
            document.getElementById("username").removeAttribute("readonly", "readonly");

            $('#role_id').prop('disabled', false).trigger('change');
            $('#province_code').prop('disabled', false).trigger('change');
            $('#city_code').prop('disabled', false).trigger('change');
            $('#district_code').prop('disabled', false).trigger('change');

            toggleRequiredClass(true);
        }

        $.ajax({
            url: `/api/areas-city?province_code=${user.province_code}`,
            type: 'GET',
            success: function (data) {
                $('#city_code').empty().append('<option></option>');
                data.data.forEach(function (city) {
                    $('#city_code').append(`<option value="${city.city_code}">${city.city}</option>`);
                });
                $('#city_code').val(user.city_code).trigger('change');

                $.ajax({
                    url: `/api/areas-district?city_code=${user.city_code}`,
                    type: 'GET',
                    success: function (data) {
                        $('#district_code').empty().append('<option></option>');
                        data.data.forEach(function (district) {
                            $('#district_code').append(`<option value="${district.district_code}">${district.district}</option>`);
                        });
                        $('#district_code').val(user.district_code).trigger('change');
                    }
                });
            }
        });

        const modalTitle = document.querySelector("#modal_user_header h2");
        modalTitle.textContent = title;
        n.show();
    }
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        name: {
                            validators: { notEmpty: { message: "Nama pengguna harus diisi" } },
                        },
                        username: {
                            validators: {
                                notEmpty: { message: "Username harus diisi" },
                            },
                        },
                        role_id: {
                            validators: {
                                notEmpty: { message: "Peran pengguna harus diisi" },
                            },
                        },
                        province_code: {
                            validators: {
                                notEmpty: { message: "Provinsi harus diisi" },
                            },
                        },
                        city_code: {
                            validators: {
                                notEmpty: { message: "Kota/Kabupaten harus diisi" },
                            },
                        },
                        district_code: {
                            validators: {
                                notEmpty: { message: "Kecamatan harus diisi" },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                });

                const i = t.querySelector('[data-kt-users-modal-action="submit"]');

                i.addEventListener("click", (event) => {
                    event.preventDefault();

                    if (currentUserId === null) {
                        o.addField('password', {
                            validators: {
                                notEmpty: { message: "Password harus diisi" },
                                stringLength: {
                                    min: 6,
                                    message: "Password minimal harus terdiri dari 6 karakter"
                                }
                            }
                        });
                    }else{
                        const fields = o.getFields();
                        const passwordFieldExists = fields.hasOwnProperty('password');

                        if (passwordFieldExists) {
                            o.removeField('password');
                        }
                    }

                    o.validate().then(function (status) {
                        if (status === 'Valid') {
                            const formData = new FormData(e);
                            const url = currentUserId ? `api/user-put/${currentUserId}` : 'api/user-post';
                            const method = 'POST';

                            $.ajax({
                                url: url,
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: method,
                                success: function(data) {
                                    if (data.status == 200) {
                                        Swal.fire({
                                            text: currentUserId ? "Berhasil mengupdate data pengguna" : "Berhasil menambah data pengguna",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                n.hide();
                                                e.reset();
                                                currentUserId = null;
                                            }
                                        });
                                        table();
                                    } else {
                                        Swal.fire({
                                            text: "Gagal menyimpan data pengguna",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                                },
                                error: function(err) {
                                    Swal.fire({
                                        text: "Gagal menyimpan data pengguna",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: { confirmButton: "btn btn-primary" },
                                    });
                                }
                            });
                        } else {
                            console.log('Validation failed');
                        }
                    });
                });

                t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentUserId = null;
                });

                t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentUserId = null;
                });
            })();
        },

        openEditModal: function (user) {
            document.getElementById("label-password").classList.remove("required");
            setUserData(user, false, "Edit Pengguna");
        },

        openDetailModal: function (user) {
            setUserData(user, true, "Detail Pengguna");
        },

        openTambahModal: function(user) {
            document.getElementById("label-password").classList.add("required");
            setUserData(user, false, "Tambah Pengguna");
        }
    };
})();

document.getElementById("add_user_button").addEventListener("click", function() {
    document.getElementById("name").value = "";
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
    document.getElementById("role_id").value = "";
    document.getElementById("province_code").value = "";
    document.getElementById("city_code").value = "";
    document.getElementById("district_code").value = "";

    let user = {
        id: null,
        name: "",
        username: "",
        role_id: "",
        province_code: "",
        city_code: "",
        district_code: "",
    }

    $('#row-password').show();
    KTModalUser.openTambahModal(user);

    toggleRequiredClass(true);
});

function handleUpdateClick(userId) {
    $('[data-field="name"]').remove();
    $('[data-field="username"]').remove();
    $('[data-field="role_id"]').remove();
    $('[data-field="password"]').remove();
    $('[data-field="province_code"]').remove();
    $('[data-field="city_code"]').remove();
    $('[data-field="district_code"]').remove();

    $('#row-password').show();

    $.ajax({
        url: `/api/user-getbyid/${userId}`,
        type: 'GET',
        success: function (data) {
            KTModalUser.openEditModal(data.data);
        },
        error: function (err) {
            Swal.fire({
                text: "Gagal mendapatkan data pengguna",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn btn-primary" },
            });
        }
    });
}

function handleDetailClick(userId)
{
    $('[data-field="name"]').remove();
    $('[data-field="username"]').remove();
    $('[data-field="role_id"]').remove();
    $('[data-field="password"]').remove();
    $('[data-field="province_code"]').remove();
    $('[data-field="city_code"]').remove();
    $('[data-field="district_code"]').remove();
    $('#row-password').hide();

    $.ajax({
        url: `/api/user-getbyid/${userId}`,
        type: 'GET',
        success: function (data) {
            KTModalUser.openDetailModal(data.data);
        },
        error: function (err) {
            Swal.fire({
                text: "Gagal mendapatkan data pengguna",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn btn-primary" },
            });
        }
    });
}

function toggleRequiredClass(addRequired) {
    const labels = [
        "label-name",
        "label-username",
        "label-role-id",
        "label-province-code",
        "label-city-code",
        "label-district-code"
    ];

    labels.forEach(labelId => {
        const labelElement = document.getElementById(labelId);
        if (labelElement) {
            if (addRequired) {
                labelElement.classList.add("required");
                $('#action-form').show();
            } else {
                labelElement.classList.remove("required");
                $('#action-form').hide();
            }
        } else {
            console.warn(`Element with ID "${labelId}" not found.`);
        }
    });
}

KTUtil.onDOMContentLoaded(function () {
    KTModalUser.init();
});

