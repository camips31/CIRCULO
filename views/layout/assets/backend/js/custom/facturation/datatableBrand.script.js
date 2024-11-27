"use strict";
// var DTCBrands = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);
  globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";

  
  var handleDataTableBrand= $("#datatable_marca").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataBrands",
      method: "POST",
      dataType: "json",
      cache: false,
      dataSrc: function (json) {
        return json.data;
      }
    },
    columns: [
      { data: null },
      { data: "codigo" },
      { data: "descripcion" },
      { data: "garantia" },
      { data: "tiempo_garantia" },
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
      {
              width: "75px",
              targets: 3,
              render: function (data, type, full, meta) {
                var status = {
                  0: { title: "SIN GARANT&Iacute;A", class: " badge badge-light-danger" },
                  1: { title: "CON GARANT&Iacute;A EN BOLIVIA", class: " badge badge-light-info" },
                };                
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

  