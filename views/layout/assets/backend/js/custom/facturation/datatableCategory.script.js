"use strict";
// var DTClients = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);
  globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";

  
  var handleDataTableCategory= $("#datatable_cat").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataCategories",
      method: "POST",
      dataType: "json",
      cache: false,
      dataSrc: function (json) {
        // console.log("Datos recibidos:", json);
        return json.data;
      }
    },
    columns: [
      { data: null },
      { data: "codigo" },
      { data: "descripcion" },
      { data: "apiestado" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="null"><i class="bi bi-pencil-square"></i></button><button class="btn btn-sm btn-clean btn-icon" id="null"><i class="bi bi-trash"></i></button>',
      },
      {
        width: "40px",
        targets: 0,
        className: 'text-center',
        render: function (data, type, full, meta) {
          return meta.row + 1;
        },
      },     
    ],
  });

  