"use strict";
var SliderFrontEnd = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const form = document.getElementById("frontend-form-slider-reg");

    var validator = FormValidation.formValidation(form, {
        fields: {
            avatar: {
                validators: {
                    notEmpty: {
                        message: 'Selecciona una imagen de tu computador'
                    },
                    file: {
                        extension: 'jpeg,jpg,png,gif',
                        type: 'image/jpeg,image/png',
                        message: 'El archivo no tiene una extensión válida'
                    },
                    file: {
                        maxSize: 1048576,   // 1024 * 1024
                        message: 'El archivo es muy pesado para subirlo'
                    },                             
                }
            },            
            vNameSlider: {
                validators: {
                    notEmpty: {
                        message: 'Registra el Título del Slider.'
                    }
                }
            },
            vPositionSlider: {
                validators: {
                    notEmpty: {
                        message: 'Selecciona el orden de posición del slider.'
                    }
                }
            },
            vTextOrientationSlider: {
                validators: {
                    notEmpty: {
                        message: 'Seleccionar la orientación del texto del slider.'
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
    const regSubmit = document.getElementById("frontend-form-slider-reg-submit");
    regSubmit.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log("validated!");
                if (status == "Valid") { // Show loading indication
                    regSubmit.setAttribute("data-kt-indicator", "on");
                    regSubmit.disabled = true;

                    var vFileContent = document.getElementById('avatar').files[0];
                    var vNameSlider = document.getElementById('vNameSlider').value;
                    var vDescSlider = document.getElementById('vDescSlider').value;
                    var vPositionSlider = document.getElementById('vPositionSlider').value;
                    var vTextOrientationSlider = document.getElementById('vTextOrientationSlider').value;

                    var form_data = new FormData();

                    form_data.append('fSliderImage',vFileContent);
                    form_data.append('vNameSlider',vNameSlider);
                    form_data.append('vDescSlider',vDescSlider);
                    form_data.append('vPositionSlider',vPositionSlider);
                    form_data.append('vTextOrientationSlider',vTextOrientationSlider);

                    $.ajax({                        
                        url: globalURLCirculo + "insert/uploadSliderImage/",
                        type: 'POST',                     
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData:false,                         
                        success: function (data) {
                            //alert(data);
                            if (data == "success") {
                                swal.fire("¡Carga Exitosa!", "Excelente, el Slider: " + document.getElementById('vNameSlider').value + " se ha subido y registrado, correctamente.", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'frontend/sliders';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT SLIDER ITEM} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });   
})();
KTUtil.onDOMContentLoaded(function () {
    SliderFrontEnd.init();
});