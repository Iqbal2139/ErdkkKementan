var KTModalPengecer = (function () {
    const t = document.getElementById("modal_pengecer"),
        e = t.querySelector("#modal_pengecer_form"),
        n = new bootstrap.Modal(t);
    let currentRetailerId = null;

    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        name: {
                            validators: { notEmpty: { message: "Nama harus diisi" } },
                        },
                        pihc_code: {
                            validators: {
                                notEmpty: { message: "PIHC Code harus diisi" },
                            },
                        },
                        sub_district_code: {
                            validators: {
                                notEmpty: { message: "Sub District Code harus diisi" },
                            },
                        },
                        is_active: {
                            validators: {
                                notEmpty: { message: "Status harus diisi" },
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

                const i = t.querySelector('[data-kt-pengecers-modal-action="submit"]');

                i.addEventListener("click", (event) => {
                    event.preventDefault();

                    o.validate().then(function (status) {
                        if (status === 'Valid') {
                            const formData = new FormData(e);
                            const url = currentRetailerId ? `api/pengecer-put/${currentRetailerId}` : 'api/pengecer-post';
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
                                            text: currentRetailerId ? "Berhasil mengupdate data pengecer" : "Berhasil menambah data pengecer",
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
                                        table();
                                    } else {
                                        Swal.fire({
                                            text: "Gagal menyimpan data pengecer",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                                },
                                error: function(err) {
                                    Swal.fire({
                                        text: "Gagal menyimpan data pengecer",
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

                t.querySelector('[data-kt-pengecers-modal-action="cancel"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentRetailerId = null;
                });

                t.querySelector('[data-kt-pengecers-modal-action="close"]').addEventListener("click", (event) => {
                    event.preventDefault();
                    e.reset();
                    n.hide();
                    currentRetailerId = null;
                });
            })();
        },

        openEditModal: function (retailer) {
            currentRetailerId = retailer.id;
            document.getElementById("name").value = retailer.name;
            document.getElementById("pihc_code").value = retailer.pihc_code;
            document.getElementById("sub_district_code").value = retailer.sub_district_code;

            const modalTitle = document.querySelector("#modal_pengecer_header h2");
            modalTitle.textContent = "Update Pengecer";

            document.getElementById(retailer.is_active == 1 ? "is_active_1" : "is_active_2").checked = true;

            n.show();
        }
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTModalPengecer.init();
});

document.getElementById("add_pengecer_button").addEventListener("click", function() {
    document.getElementById("name").value = "";
    document.getElementById("pihc_code").value = "";
    document.getElementById("sub_district_code").value = "";
    document.getElementById("is_active_1").checked = false;
    document.getElementById("is_active_2").checked = false;

    const modalTitle = document.querySelector("#modal_pengecer_header h2");
    modalTitle.textContent = "Tambah Pengecer";
});

function handleUpdateClick(retailerId) {
    $('[data-field="name"]').remove();
    $('[data-field="pihc_code"]').remove();
    $('[data-field="sub_district_code"]').remove();
    $('[data-field="is_active"]').remove();

    $.ajax({
        url: `/api/pengecer-show/${retailerId}`,
        type: 'GET',
        success: function (data) {
            KTModalPengecer.openEditModal(data.data);
        },
        error: function (err) {
            Swal.fire({
                text: "Gagal mendapatkan data pengecer",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { confirmButton: "btn btn-primary" },
            });
        }
    });
}
