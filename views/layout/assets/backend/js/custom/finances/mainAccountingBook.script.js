"use strict";
var MainAccountingBook = (function () {
    var globalURLCirculo = localStorage.getItem(globalURLCirculo); 

    // Submit button handler
    const submitButton = document.getElementById("submitConsolidateBalance");
    submitButton.addEventListener("click", function (e) { // Prevent default button action
        e.preventDefault();
        var vTotalSaldo = document.getElementById('vTotalSaldo').value;
        var vCodChartOfAccount = document.getElementById('vCodChartOfAccount').value;
        var vMonth = document.getElementById('vMonth').value;
        swal.fire({
          title:
            "¿Quieres realizar el Cierre Mensual del Libro Mayor Seleccionado?",
          text: "Esta acción actualizará los datos contables para el mes próximo al cierre",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Consolidar!",
          cancelButtonText: "No",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
                url: globalURLCirculo + "insert/consolidateBalance/",
                type: "POST",
                data: {'vTotalSaldo' : vTotalSaldo, 'vCodChartOfAccount' : vCodChartOfAccount, 'vMonth' : vMonth},
              success: function (data) {
                alert(data);
                /*if (data == "success-module") {
                  swal
                    .fire(
                      "Excelente!",
                      "El menú " + data[1] + " se asignó como Módulo del sistema.",
                      "success"
                    )
                    .then(function () {
                      location.reload();
                    });
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10002 ERR-UPDATE {MODULE ASSIGN} ",
                    "warning"
                  );
                }*/
              },
            });
          }
        });
    });
    
})();
KTUtil.onDOMContentLoaded(function () {
    MainAccountingBook.init();
});
