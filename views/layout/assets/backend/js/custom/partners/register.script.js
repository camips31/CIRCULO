"use strict";
var PartnersReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const form = document.getElementById("partners-form-reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            vNumAccion: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vCategoria: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vFechaIngreso: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vNombres: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vApellidos: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vFechaNacimiento: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },            
            vCarnetIdentidad: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },                    
            vSexo: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },                    
            vCelular: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vMail: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },                                
            vCiudad: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },
            vNombreNit: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
                    }
                }
            },                    
            vNIT: {
                validators: {
                    notEmpty: {
                        message: 'Campo Requerido'
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
    const submitButton = document.getElementById("partners-form-reg-submit");
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
                        url: globalURLCirculo + "insert/registerPartner/",
                        type: "POST",
                        data: $('#partners-form-reg').serialize(),
                        success: function (data) {
                            if (data == "success") {
                                swal.fire("¡Registro!", "Excelente, el socio con nombre " + document.getElementById('vNombres').value + " se ha registrado, correctamente.", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'partners/list';
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
    PartnersReg.init();
});