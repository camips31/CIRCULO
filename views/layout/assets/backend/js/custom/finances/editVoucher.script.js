"use strict";
var editVouchers = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    

    // FECHA DEL COMPROBANTE
    $("#vDateVoucher").flatpickr({dateFormat: "Y/m/d",});

    const form = document.getElementById("finances_form_vouchers_edit");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vCodChartOfAccount: {
                validators: {
                    notEmpty: {
                        message: "Seleccione el Plan de Cuenta"
                    }
                }
            },
            vVoucherType: {
                validators: {
                    notEmpty: {
                        message: "Seleccione el tipo de comprobante"
                    }
                }
            },
            vDateVoucher: {
                validators: {
                    notEmpty: {
                        message: "Seleccione la fecha del comprobante"
                    }
                }
            },            
            vAmount: {
                validators: {
                    notEmpty: {
                        message: "Registre el monto del comprobante"
                    }
                }
            },
            vVoucherDesc: {
                validators: {
                    notEmpty: {
                        message: "Debe detallar el comprobante"
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

    const submitEditButton = document.getElementById("finances_form_vouchers_edit_submit");
    submitEditButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");

                if (status == "Valid") { // Show loading indication
                    submitEditButton.setAttribute("data-kt-indicator", "on");
                    submitEditButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "update/voucher/",
                        type: "POST",
                        data: $('#finances_form_vouchers_edit').serialize(),
                        success: function (data) {
                            alert(data);
                            var vCodAccountingSeat = document.getElementById("vCodAccountingSeat").value;
                            if (data == "success") {
                                swal.fire("¡Registro!", "El Comprobante se ha modificado correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'finances/accountSeat/' + vCodAccountingSeat;
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10004 ERR-INSERT {PURCHASE UPDATE/INSERT VOUCHER} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });    
    
})();
KTUtil.onDOMContentLoaded(function () {
    editVouchers.init();
});
