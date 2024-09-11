"use strict";
var ProfileInfo = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const form = document.getElementById("profile-form-info-update");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vName: {
                validators: {
                    notEmpty: {
                        message: "Registro de Nombres del perfil personal"
                    }
                }
            },
            vNameLast: {
                validators: {
                    notEmpty: {
                        message: "Registre los Apellidos del perfil personal"
                    }
                }
            },
            vAddress: {
                validators: {
                    notEmpty: {
                        message: "Registre la dirección de la persona"
                    }
                }
            },
            vWhatsapp: {
                validators: {
                    notEmpty: {
                        message: "Registre el número de WhatsApp"
                    }
                }
            },									

        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5(
                {rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: ""}
            )
        }
    });

    // Submit button handler
    const profileInfoSubmitButton = document.getElementById("profile-form-info-update-submit");
    profileInfoSubmitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");

                if (status == "Valid") { // Show loading indication
                    profileInfoSubmitButton.setAttribute("data-kt-indicator", "on");
                    profileInfoSubmitButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "update/profileInfo/",
                        type: "POST",
                        data: $('#profile-form-info-update').serialize(),
                        success: function (data) {
                            alert(data);
                            if (data == "success") {
                                swal.fire("Actualizado!", "Los datos del perfil, se actualizaron correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'profile/personEdit';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10004 ERR-INSERT {PURCHASE UPDATE/INSERT PROFILE INFO TABLE} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });
})();
KTUtil.onDOMContentLoaded(function () {
    ProfileInfo.init();
});