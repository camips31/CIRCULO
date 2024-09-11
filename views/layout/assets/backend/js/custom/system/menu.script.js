"use strict";

// Class Definition
var MUT_IdEn_Menu = function() {
    
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);
    
    var _handleMenuForm = function() {
        
        var validation;
        var form = KTUtil.getById('system-form-menu');
        
        validation = FormValidation.formValidation(
            form,
			{
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
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);        
        
        $('#system-form-reg-menu-submit').on('click', function (e) {
            e.preventDefault();

			alert('hola');
            
            KTApp.blockPage({
                overlayColor: 'red',
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });            

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    
                    $.ajax({                        
                        type: 'POST',
                        url: globalURLCirculo + 'system/registerMenu/',                     
                        data: $('#system-form-menu').serialize(), 
                        success:function(data){
							alert(data);
                                KTApp.unblockPage();
                                if(data == 'success'){
                                    var vMenu = document.getElementById('vNameMenu').value;
                                    swal.fire({
                                        text: "Excelente, el menú " + vMenu + " se ha registrado, correctamente.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'system/menuList';
                                    });
                                } else if(data == 'error'){
                                    swal.fire({
                                        text: "¡UPS!, Existe un error.",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, intentar de nuevo",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'system/menuReg';
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
        
        $('#system-form-edit-menu-submit').on('click', function (e) {
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
                        url: globalURLCirculo + 'system/updateMenu/',                     
                        data: $('#system-form-menu').serialize(), 
                        success:function(data){
                                KTApp.unblockPage();
                                if(data == 'success'){
                                    var vMenu = document.getElementById('vNameMenu').value;
                                    swal.fire({
                                        text: "Excelente, el menú " + vMenu + " se ha modificado, correctamente.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'system/menuList';
                                    });
                                } else if(data == 'error'){
                                    swal.fire({
                                        text: "¡UPS!, Existe un error.",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, intentar de nuevo",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'system/menuEdit';
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
            _handleMenuForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    MUT_IdEn_Menu.init();
});
