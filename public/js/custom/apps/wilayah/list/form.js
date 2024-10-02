var KTModalWilayah = (function () {
    const t = document.getElementById("modal_wilayah"),
        e = t.querySelector("#modal_wilayah_form"),
        n = new bootstrap.Modal(t);
    let currentRetailerId = null;

    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        thn: {
                            validators: { notEmpty: { message: "Tahun harus diisi" } },
                        },
                        sub_distric_code: {
                            validators: {
                                notEmpty: { message: "Sub District Code harus diisi" },
                            },
                        },
                        sub_district: {
                            validators: {
                                notEmpty: { message: "Sub District harus diisi" },
                            },
                        },
                        district: {
                            validators: {
                                notEmpty: { message: "District harus diisi" },
                            },
                        },
                        district_code: {
                            validators: {
                                notEmpty: { message: "District Code harus diisi" },
                            },
                        },
                        city: {
                            validators: {
                                notEmpty: { message: "City harus diisi" },
                            },
                        },
                        city_code: {
                            validators: {
                                notEmpty: { message: "City Code harus diisi" },
                            },
                        },
                        province: {
                            validators: {
                                notEmpty: { message: "Province harus diisi" },
                            },
                        },
                        province_code: {
                            validators: {
                                notEmpty: { message: "Province Code harus diisi" },
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

                const i = t.querySelector('[data-kt-wilayahs-modal-action="submit"]');

                i.addEventListener("click", (event) => {
                    event.preventDefault();

                    o.validate().then(function (status) {
                        if (status === 'Valid') {
                            const formData = new FormData(e);
                            const url = currentRetailerId ? `api/wilayah-put/${currentRetailerId}` : 'api/wilayah-post';
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
                                            text: currentRetailerId ? "Berhasil mengupdate data wilayah" : "Berhasil menambah data wilayah",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                n.hide();
                                                e.reset();
                                                currentRetailerId = null;
                                            }
                                        });
                                        tableWilayah();
                                    } else {
                                        Swal.fire({
                                            text: "Gagal menyimpan data wilayah",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                                },
                                error: function(err) {
                                    Swal.fire({
                                        text: "Gagal menyimpan data wilayah",
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

                t.querySelector('[data-kt-wilayahs-modal-action="cancel"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentRetailerId = null;
                });

                t.querySelector('[data-kt-wilayahs-modal-action="close"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentRetailerId = null;
                });
            })();
        },

        openEditModal: function (wilayah) {
            currentRetailerId = wilayah.id;
            document.getElementById("thn").value = wilayah.thn;
            document.getElementById("sub_district_code").value = wilayah.sub_district_code;
            document.getElementById("sub_district").value = wilayah.sub_district;
            document.getElementById("district").value = wilayah.district;
            document.getElementById("district_code").value = wilayah.district_code;
            document.getElementById("city").value = wilayah.city;
            document.getElementById("city_code").value = wilayah.city_code;
            document.getElementById("province").value = wilayah.province;
            document.getElementById("province_code").value = wilayah.province_code;

            const modalTitle = document.querySelector("#modal_wilayah_header h2");
            modalTitle.textContent = "Update Wilayah";

            n.show();
        }

    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTModalWilayah.init();
});

document.getElementById("add_wilayah_button").addEventListener("click", function() {
    document.getElementById("thn").value = "";
    document.getElementById("sub_district_code").value = "";
    document.getElementById("sub_district").value = "";
    document.getElementById("district").value = "";
    document.getElementById("district_code").value = "";
    document.getElementById("city").value = "";
    document.getElementById("city_code").value = "";
    document.getElementById("province").value = "";
    document.getElementById("province_code").value = "";

    const modalTitle = document.querySelector("#modal_wilayah_header h2");
    modalTitle.textContent = "Tambah Wilayah";
});

function handleUpdateClick(wilayahId) {
    $('[data-field="thn"]').remove();
    $('[data-field="sub_district_code"]').remove();
    $('[data-field="sub_district"]').remove();
    $('[data-field="district"]').remove();
    $('[data-field="district_code"]').remove();
    $('[data-field="city"]').remove();
    $('[data-field="city_code"]').remove();
    $('[data-field="province"]').remove();
    $('[data-field="province_code"]').remove();


    $.ajax({
        url: `/api/wilayah-show/${wilayahId}`,
        type: 'GET',
        success: function (data) {
            KTModalWilayah.openEditModal(data.data);
        },
        error: function (err) {
            Swal.fire({
                text: "Gagal mendapatkan data wilayah",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn btn-primary" },
            });
        }
    });
}

