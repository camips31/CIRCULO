"use strict";
var SectorFrontEnd = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const form = document.getElementById("frontend-form-sectors-reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vNameSector: {
                validators: {
                    notEmpty: {
                        message: 'Registra el nombre del Sector.'
                    }
                }
            },
            vDescSector: {
                validators: {
                    notEmpty: {
                        message: 'Registra la descripción del Sector.'
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
    const regSubmit = document.getElementById("frontend-form-sectors-reg-submit");
    regSubmit.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();
        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");
                if (status == "Valid") { // Show loading indication
                    regSubmit.setAttribute("data-kt-indicator", "on");
                    regSubmit.disabled = true;
                    $.ajax({                        
                        url: globalURLCirculo + "insert/insertSector/",
                        type: 'POST',                     
                        data: $('#frontend-form-sectors-reg').serialize(),                        
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("Registro Exitoso!", "Excelente, el Sector: " + document.getElementById('vNameSector').value + " se ha registrado correctamente.", "success").then(function () {
                                    window.location = globalURLCirculo + 'frontend/sectors';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10006 ERR-INSERT {INSERT SECTOR ITEM} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });   
})();
KTUtil.onDOMContentLoaded(function () {
    SectorFrontEnd.init();
});