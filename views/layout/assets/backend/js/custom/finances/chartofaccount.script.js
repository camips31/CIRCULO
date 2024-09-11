"use strict";
var ChartOfAccount = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const formChartOfAccount = document.getElementById("finances_form_chartofaccount_reg");

    var validatorFormChartOfAccount = FormValidation.formValidation(formChartOfAccount, {
        fields: {
            vNumCodChartOfAccounts: {
                validators: {
                    notEmpty: {
                        message: "Registra el Codigo del Plan de Cuentas"
                    }
                }
            },
            vChartOfAccountsName: {
                validators: {
                    notEmpty: {
                        message: "Registra el Nombre del Plan de Cuentas"
                    }
                }
            },
            vTAccount: {
                validators: {
                    notEmpty: {
                        message: "Selecciona la cuenta T"
                    }
                }
            },
            vActive: {
                validators: {
                    notEmpty: {
                        message: "Selecciona el estado del Plan de Cuentas"
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
    const chartOfAccountRegSubmitButton = document.getElementById("finances_reg_chartofaccount_submit");
    chartOfAccountRegSubmitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validatorFormChartOfAccount) {
            validatorFormChartOfAccount.validate().then(function (status) {
                console.log("validated!");

                if (status == "Valid") { // Show loading indication
                    chartOfAccountRegSubmitButton.setAttribute("data-kt-indicator", "on");
                    chartOfAccountRegSubmitButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "insert/chartOfAccount/",
                        type: "POST",
                        data: $('#finances_form_chartofaccount_reg').serialize(),
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Registro!", "El Plan de Cuentas se ha registrado correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'finances/chartOfAccountList';
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
    ChartOfAccount.init();
});
