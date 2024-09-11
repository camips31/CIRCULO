"use strict";
var KTSignupGeneral = function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);


// Define form element
const form = document.getElementById('kt_sign_up_form');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            names: {
              validators: { notEmpty: { message: "Names is required" } },
            },
            lastnames: {
              validators: { notEmpty: { message: "Lastnames is required" } },
            },                      
            email: {
                validators: {
                  regexp: {
                    regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                    message: "The value is not a valid email address",
                  },
                  notEmpty: { message: "Email address is required" },
                },
              },
            password: {
                validators: {
                    notEmpty: {
                        message: 'password input is required'
                    }
                }
            },
            repassword: {
                validators: {
                    notEmpty: {
                        message: 'password input is required'
                    },
                    identical: {
                        compare: function() {
                            return form.querySelector('[name="password"]').value;
                        },
                        message: 'The password and its confirm are not the same'
                    }
                }
            },                        
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    }
);

// Submit button handler
const submitButton = document.getElementById('kt_sign_up_submit');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();

    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
            console.log('validated!');

            if (status == 'Valid') {
                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');

                // Disable button to avoid multiple click
                submitButton.disabled = true;

                // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                $.ajax({                        
                    type: 'POST',
                    url: globalURLCirculo + 'auth/RegisterMethod/',                     
                    data: $('#kt_sign_up_form').serialize(), 
                    success:function(data){
                        alert(data);
                            if(data == 'success'){
                                swal.fire({
                                    text: "¡Bienvenido!, a la Plataforma MUT de Ideas-Envision",
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
                /*setTimeout(function () {
                    // Remove loading indication
                    submitButton.removeAttribute('data-kt-indicator');

                    // Enable button
                    submitButton.disabled = false;

                    // Show popup confirmation
                    Swal.fire({
                        text: "Form has been successfully submitted!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    //form.submit(); // Submit form
                }, 2000);*/
            }
        });
    }
});

    
}();
KTUtil.onDOMContentLoaded((function () {
    KTSignupGeneral.init()
}));
