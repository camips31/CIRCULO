"use strict";
var Receipts = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    

    // FECHA DEL COMPROBANTE
    $("#vDateReceipt").flatpickr({dateFormat: "Y/m/d",});

    const form = document.getElementById("finances_form_receipts_reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vCodTypeReceipt: {
                validators: {
                    notEmpty: {
                        message: "Seleccione el tipo de recibo"
                    }
                }
            },
            vDateReceipt: {
                validators: {
                    notEmpty: {
                        message: "Seleccione la fecha del comprobante"
                    }
                }
            },
            vCodPartner: {
                validators: {
                    notEmpty: {
                        message: "Seleccionar Socio"
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
            vReceiptDesc: {
                validators: {
                    notEmpty: {
                        message: "Debe detallar el recibo"
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
    const submitButton = document.getElementById("finances_form_receipts_submit");
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
                        url: globalURLCirculo + "insert/receipt/",
                        type: "POST",
                        data: $('#finances_form_receipts_reg').serialize(),
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Registro!", "El Recibo se ha registrado correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'finances/receipts';
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


    $('#vCodTypeReceipt').on('change', function () {
    //alert(this.value);
    var vCodTypeReceipt = this.value;
    $.ajax({                        
        type: 'POST',
        data: {'vCodTypeReceipt' : vCodTypeReceipt}, 
        url: globalURLCirculo + "select/dataCorrelativeReceiptNumber/",
        success:function(data){
            //alert(data);
            document.getElementById('vNumCorrelativeShow').value = data;
            document.getElementById('vNumCorrelative').value = data;
        }
    });        
    });
    
})();
KTUtil.onDOMContentLoaded(function () {
    Receipts.init();
});
