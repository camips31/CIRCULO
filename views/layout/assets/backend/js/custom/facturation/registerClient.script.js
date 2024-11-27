"use strict";
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);
    globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";
    
    const formAna = document.getElementById("cliente_Ana");

    // Submit button handler
    const btnClient = document.getElementById("btn_register_client");
    formAna.addEventListener("submit", function (e) { // Prevent default button action
        e.preventDefault();
        
        // Validate form before submit
        if (true) {   
                if (true) { // Show loading indication
                    btnClient.setAttribute("data-kt-indicator", "on");
                    btnClient.disabled = true;                    
                    $.ajax({
                        url: globalURLCirculo + "insert/registerClient/",
                        type: "POST",
                        data: $('#cliente_Ana').serialize(),
                        success: function (data) {
                            if (data.includes("success")) {
                                swal.fire("¡Registro!", "Excelente, el cliente con nombre " + document.getElementById('vNombres').value + " se ha registrado, correctamente.", "success").then(function () {
                                    //location.reload();
                                    // window.location = globalURLCirculo + 'facturation/clients';
                                });
                            } else {
                                // console.log(typeof data);                                 
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT MENU ITEM} ", "warning");
                            }
                        },
                        error: function (xhr, status, error) {
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
