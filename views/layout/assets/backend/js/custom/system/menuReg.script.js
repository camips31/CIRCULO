"use strict";
var MenuReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const formSystemMenu = document.getElementById("system-form-menu-reg");

    var validatorSystemMenu = FormValidation.formValidation(formSystemMenu, {
        fields: {
            vLevel1: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el Nivel 1.'
                    }
                }
            },
            vLevel2: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el Nivel 2.'
                    }
                }
            },
            vLevel3: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el Nivel 3.'
                    }
                }
            },
            vLevel4: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el Nivel 4.'
                    }
                }
            },
            vParentMenu: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el nivel de padre.'
                    }
                }
            },
            vPositionMenu: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar la posición del menú.'
                    }
                }
            },                    
            vRoleMenu: {
                validators: {
                    notEmpty: {
                        message: 'Asignar un privilegio al menú.'
                    }
                }
            },                    
            vNameMenu: {
                validators: {
                    notEmpty: {
                        message: 'Registrar el nombre del menú.'
                    }
                }
            },                    
            vControllerActive: {
                validators: {
                    notEmpty: {
                        message: 'Registrar el controlador activo del menú.'
                    }
                }
            },
            vMethodActive: {
                validators: {
                    notEmpty: {
                        message: 'Registrar el método activo del menú.'
                    }
                }
            },                    
            vSessionMenu: {
                validators: {
                    notEmpty: {
                        message: 'Asignar un tipo de sesión al menú.'
                    }
                }
            },                    
            vActiveMenu: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar el estado del menú.'
                    }
                }
            },                    
            vDescMenu: {
                validators: {
                    notEmpty: {
                        message: 'Descripción corta del objetivo del menú.'
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
    const SystemMenuRegSubmitButton = document.getElementById("system-form-menu-reg-submit");
    SystemMenuRegSubmitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validatorSystemMenu) {
            validatorSystemMenu.validate().then(function (status) {
                console.log("validated!");
                if (status == "Valid") { // Show loading indication
                    SystemMenuRegSubmitButton.setAttribute("data-kt-indicator", "on");
                    SystemMenuRegSubmitButton.disabled = true;
                    $.ajax({
                        url: globalURLCirculo + "system/registerMenu/",
                        type: "POST",
                        data: $('#system-form-menu-reg').serialize(),
                        success: function (data) {
                            if (data == "success") {
                                swal.fire("¡Registro!", "Excelente, el menú " + document.getElementById('vNameMenu').value + " se ha registrado, correctamente.", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'system/menuList';
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
    MenuReg.init();
});