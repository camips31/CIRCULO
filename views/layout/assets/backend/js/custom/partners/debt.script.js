"use strict";
var PartnersDebtReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    // FECHA DEL COMPROBANTE
    $("#vDateDebt").flatpickr({dateFormat: "Y/m/d",});    

    const form = document.getElementById("partners-form-debt-reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vCodPartner: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar Socio'
                    }
                }
            },
            vCodChartOfAccount: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el tipo de Cuenta'
                    }
                }
            },
            vTypeDebt: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el tipo de deuda'
                    }
                }
            },                        
            vMonth: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el mes de la deuda'
                    }
                }
            },
            vDateDebt: {
                validators: {
                    notEmpty: {
                        message: 'Registrar fecha de la deuda'
                    }
                }
            },
            vAmountDebt: {
                validators: {
                    notEmpty: {
                        message: 'Registrar monto de la deuda'
                    }
                }
            },
            vDescDebt: {
                validators: {
                    notEmpty: {
                        message: 'Describir la deuda'
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
    const submitButton = document.getElementById("partners-form-debt-reg-submit");
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
                        url: globalURLCirculo + "insert/registerDebt/",
                        type: "POST",
                        data: $('#partners-form-debt-reg').serialize(),
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Registro!", "Excelente, Se ha creado la deuda " + document.getElementById('vTypeDebt').value + ", correctamente.", "success").then(function () {
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
    PartnersDebtReg.init();
});