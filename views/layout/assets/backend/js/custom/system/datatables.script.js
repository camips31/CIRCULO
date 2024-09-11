"use strict";
var Datatables = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);

  var excelLoadTable = $("#datatable_excel").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataFromExcel",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "a" },
      { data: "b" },
      { data: "c" },
      { data: "d" },
      { data: "e" },
      { data: "f" },
      { data: "g" },
      { data: "h" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnEditDailyEntry"><i class="la la-edit"></i></button>',
      },
    ],
  });

  $("#searchExcel").on("keyup", function () {
    excelLoadTable.search(this.value).draw();
  });

  $("#datatable_excel tbody").on("click", "button", function () {
    var action = this.id;
    var data = excelLoadTable.row($(this).parents("tr")).data();

    if (action == "BtnEditDailyEntry") {
      swal
        .fire({
          title:
            "¿Quieres Registrar correctamente la compra de la factura: " +
            data["d"] +
            " en el sistema?",
          text: "Esta acción es irreversible, por favor ten cuidado.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Registrar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            window.location =
              globalURLCirculo +
              "finances/editDailyEntries/" +
              data["d"] +
              "/" +
              "d";
          }
        });
    }
  });

  var handleMenuTable = $("#datatable_menu").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataMenuSide",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_codmenu" },
      { data: "n_level1" },
      { data: "n_level2" },
      { data: "n_level3" },
      { data: "n_level4" },
      { data: "c_controlleractive" },
      { data: "c_title" },
      { data: "n_parent" },
      { data: "c_menutype" },
      { data: "n_positionmenu" },
      { data: "c_url" },
      { data: "n_session" },
      { data: "n_active" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnEditMenu"><i class="la la-edit"></i></button><button class="btn btn-sm btn-clean btn-icon" id="BtnDeleteMenu"><i class="la la-trash"></i></button>',
      },
      {
        width: "75px",
        targets: 1,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "inactivo", class: " badge badge-light-danger" },
            1: { title: "Level 1", class: " badge badge-light-info" },
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
        targets: 2,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "inactivo", class: " badge badge-light-danger" },
            1: { title: "Level 2", class: " badge badge-light-info" },
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
        targets: 3,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "inactivo", class: " badge badge-light-danger" },
            1: { title: "Level 3", class: " badge badge-light-info" },
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
        targets: 4,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "inactivo", class: " badge badge-light-danger" },
            1: { title: "Level 4", class: " badge badge-light-info" },
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
        targets: 11,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Sin Loguear", class: " badge badge-light-warning" },
            1: { title: "Logueado", class: " badge badge-light-success" },
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
        targets: 12,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Inactivo", class: " badge badge-light-warning" },
            1: { title: "Activo", class: " badge badge-light-success" },
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
  $("#searchMenu").on("keyup", function () {
    handleMenuTable.search(this.value).draw();
  });

  $("#datatable_menu tbody").on("click", "button", function () {
    var action = this.id;
    var data = handleMenuTable.row($(this).parents("tr")).data();

    if (action == "BtnEditMenu") {
      swal
        .fire({
          title:
            "¿Quieres editar el menú: " +
            data["c_title"] +
            " del sistema?",
          text: "Esta acción te llevará a otra pantalla.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Editar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
              window.location = globalURLCirculo + 'system/menuEdit/' + data['n_codmenu'];
          }
        });
    }

  });  

  var handleSuppliersTable = $("#datatable_suppliers").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataSuppliers",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_codsupplier" },
      { data: "n_codtypesupplier" },
      { data: "c_namesupplier" },
      { data: "c_businesssector" },
      { data: "n_nitsupplier" },
      { data: "c_bankaccountsupplier" },
      { data: "c_nameaccountsupplier" },
      { data: "c_typeaccountsupplier" },
      { data: "c_accountsupplier" },
      { data: "n_status" },
      { data: null },
    ],
    columnDefs: [
      /*{
                "targets": -1,
                //"data": null,
                "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnEditActivoFijo\"><i class=\"la la-edit\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnDeleteActivoFijo\"><i class=\"la la-trash\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnAddImageActivoFijo\"><i class=\"la la-image\"></i></button>"
            },*/
      {
        targets: -1,
        data: null,
        orderable: false,
        defaultContent:
          '<button class="btn btn-clean btn-icon" id="BtnDeleteChartOfAccount"><i class="la la-trash text-danger fs-4"></i></button><button class="btn btn-clean btn-icon" id="BtnChangeChartOfAccount"><i class="la la-refresh  text-success fs-4"></i></button><button class="btn btn-clean btn-icon" id="BtnEditChartOfAccount"><i class="la la-edit  text-info fs-4"></i></button>',
      },
      {
        width: "75px",
        targets: 3,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Nulo", class: " badge badge-light-warning" },
            1: { title: "DEBE", class: " badge badge-light-success" },
            2: { title: "HABER", class: " badge badge-light-danger" },
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
        targets: 4,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Inactivo", class: " badge badge-light-warning" },
            1: { title: "Activo", class: " badge badge-light-success" },
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

  var handleMenuToModule = $("#datatable_menulist").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
    },
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnAddModule"><i class="la la-plus"></i></button>',
      },
      {
        width: "75px",
        targets: 3,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "Error", class: " label-light-danger" },
            1: { title: "activo", class: " label-light-success" },
            2: { title: "inactivo", class: " label-light-warning" },
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

  $("#datatable_menulist tbody").on("click", "button", function () {
    var action = this.id;
    var data = handleMenuToModule.row($(this).parents("tr")).data();
    var vCode = $(this).parents("tr").attr("code");

    if (action == "BtnAddModule") {
      swal
        .fire({
          title:
            "¿Quieres agregar el menú " + data[1] + " como Módulo del sistema?",
          text: "Esta acción actualizará los módulos del sistema",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, agregar!",
          cancelButtonText: "No, no agregar",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
              url: globalURLCirculo + "system/moduleRegister/",
              type: "POST",
              data: { vCodeMenu: vCode },
              success: function (data) {
                if (data == "success-module") {
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
                }
              },
            });
          } else if (result.dismiss === "cancel") {
            swal.fire(
              "Cancelado",
              "El menú: " + data[1] + " no se agregará como Módulo",
              "info"
            );
          }
        });
    }
  });

  var handleUsersTable = $("#datatable_users").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataUsers",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_coduser" },
      { data: "c_rrss_id" },
      { data: "c_profile_img" },
      //{ data: "c_username" },
      //{ data: "c_pass1" },
      //{ data: "c_pass2" },
      { data: "c_email" },
      { data: "c_userrole" },
      //{ data: "n_tnc" },
      { data: "n_activationcode" },
      { data: "n_status" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnEditUser"><i class="la la-edit"></i></button><button class="btn btn-sm btn-clean btn-icon" id="BtnDeleteUser"><i class="la la-edit"></i></button><button class="btn btn-sm btn-clean btn-icon" id="BtnPrivilegeUser"><i class="la la-user-lock"></i></button>',
      },
    ],
  });

  $("#searchExcel").on("keyup", function () {
    handleUsersTable.search(this.value).draw();
  });

  $("#datatable_users tbody").on("click", "button", function () {
    var action = this.id;
    var data = handleUsersTable.row($(this).parents("tr")).data();

    if (action == "BtnPrivilegeUser") {
      swal
        .fire({
          title:
            "¿Quieres modificar los privilegios para módulos del usuario: " +
            data["c_email"] +
            " en el sistema?",
          text: "Esta acción te llevará a otra pantalla.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Registrar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            window.location = globalURLCirculo + 'system/usersModule/' + data["n_coduser"];
          }
        });
    }
  });

  var handleAssignMethodsModulesTable = $('#datatable_method_modules').DataTable( {
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "columnDefs": [
        {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnAssignMenu\"><i class=\"la la-check\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnUnAssignMenu\"><i class=\"la la-remove\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnViewSubLevel\"><i class=\"la la-eye\"></i></button>"
        },
        {
            "className": "dt-center",
            targets: 0,
        },
        {
            targets: 3,
            render: function(data, type, full, meta) {
                var status = {
                    0: {'title': 'No Asignado', 'class': ' label-light-danger'},
                    1: {'title': 'Asignado', 'class': ' label-light-success'},
                };
                if (typeof status[data] === 'undefined') {
                    return data;
                }
                return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
            },
        },
    ]
});

$('#datatable_method_modules tbody').on( 'click', 'button', function () {

    var action = this.id;
    var data = handleAssignMethodsModulesTable.row($(this).parents('tr')).data();
    var vCode = $(this).parents('tr').attr('code');
    var vUserCode = $(this).parents('tr').attr('usercode');
    var vPrevMenuCode = $(this).parents('tr').attr('prevmenu');        

    if (action=='BtnAssignMenu'){
        swal.fire({
            title: "¿Quieres asignar el privilegio " + data[1] + "?",
            text: "Esta acción actualizará la información y refrescará la pantalla.",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Si, asignar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result){            
            if(result.value){
                window.location = globalURLCirculo + 'system/assignPrivilegeMethod/' + vPrevMenuCode + '/' + vUserCode+ '/' + vCode;
            }
        });            
    }

    if (action=='BtnUnAssignMenu'){
        swal.fire({
            title: "¿Quieres eliminar el privilegio " + data[1] + "?",
            text: "Esta acción actualizará la información y refrescará la pantalla.",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result){            
            if(result.value){
                window.location = globalURLCirculo + 'system/unAssignPrivilegeMethod/' + vPrevMenuCode + '/' + vUserCode+ '/' + vCode;
            }
        });            
    }        

    if (action=='BtnViewSubLevel'){
        swal.fire({
            title: "¿Quieres visualizar los sub menús del menú " + data[2] + "?",
            text: "Esta acción te llevará a otra pantalla.",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Si, visualizar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result){            
            if(result.value){
                window.location = globalURLCirculo + 'system/usersMethod/' + vCode + '/' + vUserCode;
            }
        });            
    }        

});  

  return {
    //main function to initiate the module
    init: function () {
      excelLoadTable();
      handleMenuTable();
      handleSuppliersTable();
      handleMenuToModule();
      handleUsersTable();
      handleAssignMethodsModulesTable();
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  Datatables.init();
});
