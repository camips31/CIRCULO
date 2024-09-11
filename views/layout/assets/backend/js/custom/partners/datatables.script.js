"use strict";
var DTPartners = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);

  var handleDataTablePartners = $("#datatable_partners").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataPartners",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_codpartner" },
      { data: "n_numaccion" },
      { data: "n_categoria" },
      { data: "d_fechaingreso" },
      { data: "t_nombres" },
      { data: "d_fechanacimiento" },
      { data: "t_carnetidentidad" },
      { data: "n_sexo" },
      { data: "n_celular" },
      { data: "t_mail" },
      { data: "n_ciudad" },
      { data: "t_nombrenit" },
      { data: "t_nit" },
      { data: "n_status" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnDeletePartner"><i class="la la-trash"></i></button>',
      },
      {
        width: "75px",
        targets: 2,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Presente", class: " badge badge-light-danger" },
            1: { title: "Ausente", class: " badge badge-light-info" },
            2: { title: "Emérito", class: " badge badge-light-warning" },
            3: { title: "Ingreso", class: " badge badge-light-success" },
            4: { title: "Participación", class: " badge badge-light-primary" },
            5: { title: "Cuota Extraordinaria", class: " badge badge-light-sucess" },
            6: { title: "Cuota Mortuoría", class: " badge badge-light-danger" },

          };
          if (typeof status[data] === "undefined") {
            return data;
          }
          return (
            '<span class="label label-lg font-weight-bold' +
            status[data].class +
            ' label-inline">' +
            status[data].title +
            "</span>"
          );
        },
      },
      {
        width: "75px",
        targets: 7,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "Masculino", class: " badge badge-light-info" },
            2: { title: "Femenino", class: " badge badge-light-danger" },
          };
          if (typeof status[data] === "undefined") {
            return data;
          }
          return (
            '<span class="label label-lg font-weight-bold' +
            status[data].class +
            ' label-inline">' +
            status[data].title +
            "</span>"
          );
        },
      },
      {
        width: "50px",
        targets: 10,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "La Paz", class: " badge badge-success" },
            2: { title: "Santa Cruz de la Sierra", class: " badge badge-success" },
            3: { title: "Cochabamba", class: " badge badge-success" },
            4: { title: "Chuquisaca", class: " badge badge-success" },
            5: { title: "Oruro", class: " badge badge-success" },
            6: { title: "Potosí", class: " badge badge-success" },
            7: { title: "Tarija", class: " badge badge-success" },
            8: { title: "Beni", class: " badge badge-success" },
            9: { title: "Pando", class: " badge badge-light-danger" }
          };
          if (typeof status[data] === "undefined") {
            return data;
          }
          return (
            '<span class="label label-lg font-weight-bold' +
            status[data].class +
            ' label-inline">' +
            status[data].title +
            "</span>"
          );
        },
      },      
      {
        width: "75px",
        targets: 13,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Inactivo", class: " badge badge-light-danger" },
            1: { title: "Activo", class: " badge badge-light-info" },
          };
          if (typeof status[data] === "undefined") {
            return data;
          }
          return (
            '<span class="label label-lg font-weight-bold' +
            status[data].class +
            ' label-inline">' +
            status[data].title +
            "</span>"
          );
        },
      },      
    ],
  });

  
  // #myInput is a <input type="text"> element
  $("#searchPartners").on("keyup", function () {
    handleDataTablePartners.search(this.value).draw();
  });

  $("#datatable_partners tbody").on("click", "button", function () {
    var action = this.id;
    var data = handleDataTablePartners.row($(this).parents("tr")).data();

    if (action == "BtnDeletePartner") {
      swal
        .fire({
          title:
            "¿Quieres eliminar al Socio: " +
            data["t_nombres"] +
            " del sistema?",
          text: "Esta acción es irreversible, por favor ten cuidado.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
              url: globalURLCirculo + "delete/partner/",
              type: "POST",
              data: { vCodPartner: data["n_codpartner"] },
              success: function (data) {
                if (data == "success") {
                  swal
                    .fire(
                      "Deleted!",
                      "El socio ha sido eliminado del sistema",
                      "success"
                    )
                    .then(function () {
                      location.reload();
                    });
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10012 ERR-DELETE {PARTNER} ",
                    "warning"
                  );
                }
              },
            });
          }
        });
    }       

});  

  return {
    //main function to initiate the module
    init: function () {
      handleDataTablePartners();
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  DTPartners.init();
});
