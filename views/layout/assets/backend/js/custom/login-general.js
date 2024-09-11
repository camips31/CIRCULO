"use strict";

// Class Definition
var KTLogin = function() {
    
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);    
    
    var _login;
    
    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }    

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'El nombre de usuario es requerido.'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'La contraseña es requerida.'
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

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    
                    $.ajax({                        
                        type: 'POST',
                        url: globalURLCirculo + 'auth/LoginMethod/',                     
                        data: $('#kt_login_signin_form').serialize(), 
                        success:function(data){
                            //alert(data);
                                if(data == 'success'){
                                    swal.fire({
                                        text: "¡Bienvenido!, a la Plataforma de Ibnorca",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'dashboard';
                                    });
                                } else if(data == 'no_active'){
                                    swal.fire({
                                        text: "¡Bienvenido!, no te olvides activar la cuenta mediante tu correo",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'dashboard';
                                    });
                                } else if(data == 'no-email'){
                                    swal.fire({
                                        text: "¡UPS!, Este correo no esta registrado, por favor verifica",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'dashboard';
                                    });
                                } else if(data == 'password-incorrect'){
                                    swal.fire({
                                        text: "¡UPS!, la contraseña es incorrecta, verifica!",
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'dashboard';
                                    });
                                }
                            }
                        });
				} else {
					swal.fire({
		                text: "Por favor, llene los campos que son requeridos para ingresar.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, los llenaré!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					names: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					lastnames: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},                    
					email: {
                        validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    repassword: {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'You must accept the terms and conditions'
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

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {                    
		        if (status == 'Valid') {
                    
                    $.ajax({                        
                        type: 'POST',
                        url: globalURLCirculo + 'auth/RegisterMethod/',                     
                        data: $('#kt_login_signup_form').serialize(), 
                        success:function(data){
                                if(data == 'success'){
                                    swal.fire({
                                        text: "¡Bienvenido!, a Ideas-Envision",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, gracias",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    }).then(function() {
                                        window.location = globalURLCirculo + 'dashboard';
                                    });
                                }
                            }
                        });
                    
				} else {
					swal.fire({
		                text: "Sorry, looks like there are some errors detected, please try again.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Submit form
                    KTUtil.scrollTop();
				} else {
					swal.fire({
		                text: "Sorry, looks like there are some errors detected, please try again.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});