"use strict";
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);
    globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";
    
    const formProduct = document.getElementById("form_producto");  

    const btnAddProduct = document.getElementById("btn_add_product");
  
    formProduct.addEventListener("submit", function (e) {
        e.preventDefault(); 
    
        console.log("dentro del btn");
        if (true) {   
            if (true) { 
                btnAddProduct.setAttribute("data-kt-indicator", "on");
                console.log("antes de enviar AJAX");
                $.ajax({
                    url: globalURLCirculo + "insert/registerProduct/", 
                    type: "POST",
                    data: $('#form_producto').serialize(), 
                    success: function (data) {
                        console.log('Respuesta del servidor:', data);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud:", error);
                    }
                });
                // $.ajax({
                //     url: globalURLCirculo + "insert/registerProduct/",
                //     type: "POST",
                //     data: $('#form_producto').serialize(),
                //     success: function (data) {
                //         console.log('Respuesta del servidor:', data); // Verificar respuesta
                //         if (data.includes("success")) {
                //             swal.fire("¡Registro!", "Excelente, se ha registrado el producto correctamente.", "success").then(function () {
                //                 // Si es necesario, redirige o recarga la página
                //                 // window.location.href = globalURLCirculo + 'facturation/products'; 
                //             });
                //         } else {          
                //             swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT MENU ITEM} ", "warning");
                //         }
                //     },
                //     error: function (xhr, status, error) {
                //         console.error("Error en la solicitud:", error);
                //         swal.fire({
                //             title: "Error",
                //             text: "Ocurrió un error en la comunicación con el servidor. Intenta de nuevo más tarde.",
                //             icon: "error"
                //         });
                //     }
                // });
            }
        }
    });
       
