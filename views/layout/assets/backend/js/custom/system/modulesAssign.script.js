"use strict";
var ModuleAssign = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);

    const formModuleAssign = document.getElementById("system-form-module-user-assign");   

    var validatorModuleAssign = FormValidation.formValidation(formModuleAssign, {
        fields: {
            vModule: {
                validators: {
                    notEmpty: {
                        message: 'Debe asignar al menos una visualización de módulo al usuario'
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
    const SystemModuleAssignSubmit = document.getElementById("system-form-module-user-assign-submit");
    SystemModuleAssignSubmit.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();

        // Validate form before submit
       if (validatorModuleAssign) {
            validatorModuleAssign.validate().then(function (status) {
                //console.log("validated!");
                if (status == "Valid") { // Show loading indication
                    SystemModuleAssignSubmit.setAttribute("data-kt-indicator", "on");
                    SystemModuleAssignSubmit.disabled = true;

                    var vStringModule = '';

                    $('input[type=checkbox]:checked').each(function() {
                        //alert($(this).val());
                        if($(this).val() !== 1){
                            vStringModule = vStringModule + "'" + $(this).val() + "',";
                        }
                   });
        
                   var vStringModule = vStringModule.substring(0, vStringModule.length - 1);

                   var dataForm = $("#system-form-module-user-assign").serializeArray();
                   dataForm.push({name: 'vModuleAssigned', value: vStringModule.substring(4)});

                    $.ajax({
                        url: globalURLCirculo + 'system/usersAssignModuleReg/',
                        type: "POST",
                        data: dataForm,
                        success: function (data) {
                            if (data == "success-assignmodule") {
                                swal.fire("Asignado!", "Excelente, el módulo " + document.getElementById('vUserName').value + " se ha asignado correctamente al usuario", "success").then(function () {
                                    //location.reload();
                                    window.location = globalURLCirculo + 'system/usersList/';
                                });
                            } else {
                                swal.fire("¡UPS!", "Hay un problema con el registro, por favor vuelva a intentar o reporte este error Code: 10005 ERR-INSERT {INSERT MENU ITEM} ", "warning");
                            }
                        }
                    });
                }
            });
        }
    });   
})();
KTUtil.onDOMContentLoaded(function () {
    ModuleAssign.init();
});