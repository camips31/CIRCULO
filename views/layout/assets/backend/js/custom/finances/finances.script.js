"use strict";
var Finances = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);   

    const form = document.getElementById("finances_form_edit");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vCodChartOfAccount: {
                validators: {
                    notEmpty: {
                        message: "Selecciona el Código del Plan de Cuentas"
                    }
                }
            },
            vCodSupplier: {
                validators: {
                    notEmpty: {
                        message: "Selecciona el Código de Proveedor"
                    }
                }
            },
            vNumBilling: {
                validators: {
                    notEmpty: {
                        message: "Registra el Número de Factura"
                    }
                }
            },
            vNumDUI: {
                validators: {
                    notEmpty: {
                        message: "Registra el Número de DUI/DIM"
                    }
                }
            },
            vDate: {
                validators: {
                    date: {
                        format: "YYYY-MM-DD",
                        message: "The value is not a valid date"
                    },
                    notEmpty: {
                        message: "Selecciona la fecha del documento"
                    }
                }
            },
            vAmountTotal: {
                validators: {
                    notEmpty: {
                        message: "Registra el total de la compra"
                    }
                }
            },
            vAmountIce: {
                validators: {
                    notEmpty: {
                        message: "Registra el total del ICE"
                    }
                }
            },
            vDiscount: {
                validators: {
                    notEmpty: {
                        message: "Registra el descuento"
                    }
                }
            },
            vControlCode: {
                validators: {
                    notEmpty: {
                        message: "Registra el Código de Control"
                    }
                }
            }
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5(
                {rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: ""}
            )
        }
    });

    // Submit button handler
    const financesEditSubmitButton = document.getElementById("finances_edit_submit");
    financesEditSubmitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");

                if (status == "Valid") { // Show loading indication
                    financesEditSubmitButton.setAttribute("data-kt-indicator", "on");
                    financesEditSubmitButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "insert/dailyEntries/",
                        type: "POST",
                        data: $('#finances_form_edit').serialize(),
                        success: function (data) {
                            if (data == "success") {
                                swal.fire("¡Registro!", "La Compra se ha registrado correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'finances/dailyEntries';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10004 ERR-INSERT {PURCHASE UPDATE/INSERT FROM EXCEL TABLE} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });
})();
KTUtil.onDOMContentLoaded(function () {
    Finances.init();
});
