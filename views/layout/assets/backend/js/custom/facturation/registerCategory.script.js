"use strict";
// var CategoryReg = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);
    globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";
    
    const formCategories = document.getElementById("form_category");  

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
    const btnCategory = document.getElementById("btn_add_category");
    formCategories.addEventListener("submit", function (e) { // Prevent default button action
        e.preventDefault();
        
        // Validate form before submit
        if (true) {   
                if (true) { // Show loading indication
                    btnCategory.setAttribute("data-kt-indicator", "on");
                    btnCategory.disabled = true;                    
                    $.ajax({
                        url: globalURLCirculo + "insert/registerCategory/",
                        type: "POST",
                        data: $('#form_category').serialize(),
                        success: function (data) {
                            if (data.includes("success")) {
                                swal.fire("¡Registro!", "Excelente, se ha registrado la categoria correctamente.", "success").then(function () {
                                    location.reload();
                                    window.location = globalURLCirculo + 'facturation/categories';
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