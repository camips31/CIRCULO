"use strict";

// Class Definition
var MUTIdEnModulesReg = function() {
    
    var globalURLIdeasEnvisionMUT = localStorage.getItem(globalURLIdeasEnvisionMUT);

    var _handleModuleReg = function() {
        
        var validation;
        var form = KTUtil.getById('system-form-modulereg');
        
        validation = FormValidation.formValidation(
            form,
			{
				fields: {
					vModuleName: {
						validators: {
							notEmpty: {
								message: 'Debe registrar el nombre descriptivo del privilegio'
							}
						}
					},
					vModuleRole: {
						validators: {
							notEmpty: {
								message: 'Debe registrar el privilegio del sistema'
							}
						}
					},                    
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);        
        
        $('#system-form-modulereg-submit').on('click', function (e) {
            e.preventDefault();
            
            KTApp.blockPage({
                overlayColor: 'red',
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });            

            validation.validate().then(function(status) {
		        if (status == 'Valid') {

                    $.ajax({                        
                        type: 'POST',
                        url: globalURLIdeasEnvisionMUT + 'system/moduleRegister/',                     
                        data: $('#system-form-modulereg').serialize(), 
                        success:function(data){

                                var vModuleName = document.getElementById('vModuleName').value;

                                KTApp.unblockPage();
                                if(data == 'success-module'){
                                    
                                    swal.fire({
                                        text: "Excelente, el privilegio " + vModuleName + ", se registró correctamente.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLIdeasEnvisionMUT + 'system/moduleReg/';
                                    });
                                } else if(data == 'error-module'){
                                    swal.fire({
                                        text: "¡UPS!, No se aregistró el privilegio " + vModuleName + ", por favor verifique.",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, intentar de nuevo",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-danger"
                                        }
                                    }).then(function() {
                                        window.location = globalURLIdeasEnvisionMUT + 'system/moduleReg/';
                                    });
                                }                                
                            }
                        });                    
                    
				} else {
                    KTApp.unblockPage();
					swal.fire({
		                text: "UPS, algo salio mal, por favor intenta de nuevo.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, lo hare!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });
    
    }    

    // Public Functions
    return {
        // public functions
        init: function() {
            _handleModuleReg();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    MUTIdEnModulesReg.init();
});
