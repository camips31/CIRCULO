"use strict";
// var ClientsReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);
    globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";
    // console.log(globalURLCirculo);
    
    const formBrand = document.getElementById("form_marca");
    // console.log(formBrand);    

    // var validator = FormValidation.formValidation(form, {
    //     fields: {
    //         vDocumento: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },
    //         vComplemento: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },
    //         vNombres: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },
    //         vApellidos: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },
    //         vCorreo: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },            
    //         vMovil: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },                    
    //         vDescripcion: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },                    
    //         vDireccion: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Campo Requerido'
    //                 }
    //             }
    //         },
    //     },

    //     plugins: {
    //         trigger: new FormValidation.plugins.Trigger(),
    //         bootstrap: new FormValidation.plugins.Bootstrap5(
    //             {rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: ""}
    //         )
    //     }
    // });

    // Submit button handler
    const btnBrand = document.getElementById("btn_add_brand");
    // console.log(btnBrand);
    formBrand.addEventListener("submit", function (e) { // Prevent default button action
        e.preventDefault();
        // console.log("dentro del btn");
        
        // Validate form before submit
        if (true) {   
                if (true) { // Show loading indication
                    btnBrand.setAttribute("data-kt-indicator", "on");
                    btnBrand.disabled = true;
                    // console.log("antes de enviar AJAX");
                    
                    $.ajax({
                        url: globalURLCirculo + "insert/registerBrand/",
                        type: "POST",
                        data: $('#form_marca').serialize(),
                        success: function (data) {
                            if (data.includes("success")) {
                                swal.fire("¡Registro!", "Excelente, se ha registrado la marca correctamente.", "success").then(function () {
                                    location.reload();
                                    window.location = globalURLCirculo + 'facturation/brands';
                                });
                            } else {          
                                                   
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT MENU ITEM} ", "warning");
                            }
                        },
                        error: function (xhr, status, error) {
                            // Manejar errores de red u otros problemas
                            console.error("Error en la solicitud:", error);
                            swal.fire({
                                title: "Error",
                                text: "Ocurrió un error en la comunicación con el servidor. Intenta de nuevo más tarde.",
                                icon: "error"
                            });
                        }
                    });
                }
        }
    });   
// })();
// KTUtil.onDOMContentLoaded(function () {
//     ClientsReg.init();
// });