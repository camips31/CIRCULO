"use strict";
var PayOffDebtReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const form = document.getElementById("partners-form-payoutoffdebt-reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vCodPartner: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar Socio'
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
    const submitButton = document.getElementById("partners-form-payoutoffdebt-reg-submit");
    submitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");
                if (status == "Valid") { // Show loading indication
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "update/updatePayOutOffDebt/",
                        type: "POST",
                        data: $('#partners-form-payoutoffdebt-reg').serialize(),
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Registro!", "Excelente, El pago se ha registrado a la deuda seleccionada, correctamente.", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'partners/debts';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT MENU ITEM} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });   
})();
KTUtil.onDOMContentLoaded(function () {
    PayOffDebtReg.init();
});