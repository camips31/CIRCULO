"use strict";
var Vouchers = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    

    // FECHA DEL COMPROBANTE
    $("#vDateVoucher").flatpickr({dateFormat: "Y/m/d",});

    const form = document.getElementById("finances_form_vouchers_reg");

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

    // Submit button handler
    const submitButton = document.getElementById("finances_form_vouchers_submit");
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
                        url: globalURLCirculo + "insert/voucher/",
                        type: "POST",
                        data: $('#finances_form_vouchers_reg').serialize(),
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Registro!", "El Comprobante se ha registrado correctamente", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'finances/vouchers';
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

    const consolidarButton = document.getElementById("finances_form_vouchers_consolidar_submit");
    consolidarButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;
        Swal.fire({
            title: "Consolidar Asiento",
            html: '<input id="swal-input1" class="swal2-input" placeholder="2024/04/22"><input id="swal-input2" class="swal2-input" placeholder="Glosa del asiento contable">',
            focusConfirm: false,
            preConfirm: () => {
            return [
                document.getElementById("swal-input1").value,
                document.getElementById("swal-input2").value
            ];
            }
        }).then(function(result) {
            //alert(result.value[1]);
            if (result.value) {
                const vDateAccountingSeat = result.value[0];
                const vDescAccountingSeat = result.value[1];
                swal.fire({
                  title: "¿Está seguro de consolidar los comprobantes en un solo asiento?",
                  text: "Esta acción comprometerá los comprobantes",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, consolidar!",
                  cancelButtonText: "No",
                  reverseButtons: true
              }).then(function(result){
                  if(result.value){
  
                      /*KTApp.blockPage({
                          overlayColor: 'red',
                          opacity: 0.1,
                          state: 'primary' // a bootstrap color
                      });*/
  
                      $.ajax({                        
                          type: 'POST',
                          data: {'vDateAccountingSeat':vDateAccountingSeat,'vDescAccountingSeat': vDescAccountingSeat}, 
                          url: globalURLCirculo + "insert/consolidateAccountingSeat/",
                          success:function(data){
                              //alert(data);
                              //KTApp.unblockPage();
                              if(data.trim() == 'success'){
                                  swal.fire({
                                      title: "Excelente!",
                                      text: "El asiento ha sido creado y consolidado exitosamente.",
                                      icon: "success"
                                  }).then(function(){
                                      window.location = globalURLCirculo + 'finances/accountingEntries';
                                  });                                   
                              }
                          }
                      });
                  }             
              });                  
              }                    
        });
       
    });
    
    if(document.querySelector('input[name="radioTypeVoucher"]')) {
        document.querySelectorAll('input[name="radioTypeVoucher"]').forEach((elem) => {
          elem.addEventListener("change", function(event) {
            var item = event.target.value;
            //alert(item);
            console.log(item);
          });
        });
      }
    
})();
KTUtil.onDOMContentLoaded(function () {
    Vouchers.init();
});
