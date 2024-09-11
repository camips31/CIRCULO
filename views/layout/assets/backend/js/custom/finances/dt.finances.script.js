"use strict";
var DTFinances = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);

  var handleChartOfAccountTable = $("#datatable_chartofaccount").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataChartOfAccount",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_codchartofaccounts" },
      { data: "n_chartofaccountname" },
      { data: "c_chartofaccountname" },
      { data: "n_taccount" },
      { data: "n_active" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="BtnChangeChartOfAccount"><i class="la la-sync"></i></button><button class="btn btn-sm btn-clean btn-icon" id="BtnDeleteChartOfAccount"><i class="la la-trash"></i></button>',
      },
      {
        width: "75px",
        targets: 3,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "DEBE", class: " badge badge-light-danger" },
            2: { title: "HABER", class: " badge badge-light-info" },
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
  $("#searchChartOfAccount").on("keyup", function () {
    handleChartOfAccountTable.search(this.value).draw();
  });

  $("#datatable_chartofaccount tbody").on("click", "button", function () {
    var action = this.id;
    var data = handleChartOfAccountTable.row($(this).parents("tr")).data();

    if (action == "BtnDeleteChartOfAccount") {
      swal
        .fire({
          title:
            "¿Quieres eliminar la Cuenta: " +
            data["c_chartofaccountname"] +
            " del Plan de Cuentas?",
          text: "Esta acción es irreversible, por favor ten cuidado.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false,          
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
              url: globalURLCirculo + "delete/chartOfAccount/",
              type: "POST",
              data: { vCodChartOfAccounts: data["n_codchartofaccounts"] },
              success: function (data) {
                if (data == "success") {
                  swal
                    .fire(
                      "Deleted!",
                      "La cuenta se ha eliminado del sistema",
                      "success"
                    )
                    .then(function () {
                      location.reload();
                    });
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10000 ERR-DELETE {CHARTOFACCOUNT} ",
                    "warning"
                  );
                }
              },
            });
          }
        });
    }

    if (action == "BtnChangeChartOfAccount") {
      swal
        .fire({
          title:
            "¿La Cuenta: " +
            data["c_chartofaccountname"] +
            " cambiará de estado en la partida doble?",
          text: "Esta acción afectará a todos tus registros contables.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, cambiar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false,          
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
              url: globalURLCirculo + "update/chartOfAccountDoubleMatch/",
              type: "POST",
              data: { vCodChartOfAccounts: data["n_codchartofaccounts"] },
              success: function (data) {
                if (data == "success") {
                  swal.fire(
                    "¡Actualizado!",
                    "La cuenta se ha modificado correctamente",
                    "success"
                  );
                  /*.then(function () {
                      location.reload();
                    });*/
                } else if (data == "error-taccount") {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10003 ERR-UPDATE {CHARTOFACCOUNT INVALID STATUS DOUBLE MATCH} ",
                    "warning"
                  );
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10001 ERR-UPDATE {CHARTOFACCOUNT DOUBLE MATCH} ",
                    "warning"
                  );
                }
              },
            });
          }
        });
    }

    if (action == "BtnEditChartOfAccount") {
      swal
        .fire({
          title:
            "¿Deseas editar la información de la Cuenta: " +
            data["c_chartofaccountname"] +
            "?",
          text: "Esta acción te llevará a otra pantalla y afectará a todos tus registros contables.",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, editar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false,          
        })
        .then(function (result) {
          if (result.value) {
            window.location = globalURLCirculo + 'finances/editChartOfAccount/' + data["n_codchartofaccounts"];
          }
        });
    }
  });


  var handleBillsTable = $("#datatable_bills").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataBills/",
      method: "POST",
      dataType: "json",
      cache: false,
    },
    columns: [
      { data: "n_codbill" },
      { data: "n_numbill" },
      { data: "n_codpartner" },
      { data: "c_namepartner" },
      { data: "n_totalbill" },
      { data: "d_datebill" },
      { data: "n_status" },
      { data: "n_active" },
      { data: null },
    ],
    columnDefs: [
      {
        targets: -1,
        //"data": null,
        defaultContent:
          '<button class="btn btn-sm btn-clean btn-icon" id="Btn"><i class="la la-eye"></i></button><button class="btn btn-sm btn-clean btn-icon" id="Btn"><i class="la la-trash"></i></button>',
      },
      {
        width: "75px",
        targets: 7,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "PENDIENTE", class: " badge badge-light-danger" },
            2: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
  $("#searchBills").on("keyup", function () {
    handleBillsTable.search(this.value).draw();
  });

  var handleVoucherAccountingSeatTable = $('#datatable_vouchers_accountingseat').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "buttons": [
        'print',
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5',
    ],
    "responsive": true,
    "order": [[2, 'asc']],      
    "columnDefs": [            
        {
            "className": "dt-center",
            targets: 0,
        },
        {
            "className": "dt-center",
            "targets": -1,
            "data": null,
            "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnChangeChartOfAccount\"><i class=\"la la-sync\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnDelete\"><i class=\"la la-trash\"></i></button>"
        },            
        {
          targets: 5,
          render: function (data, type, full, meta) {
            var status = {
              1: { title: "PENDIENTE", class: " badge badge-light-danger" },
              2: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
    ]
});

$("#searchVoucherAccountingSeats").on("keyup", function () {
  handleVoucherAccountingSeatTable.search(this.value).draw();
});

$('#datatable_vouchers_accountingseat tbody').on( 'click', 'button', function () {

    var action = this.id;
    var data = handleVoucherAccountingSeatTable.row($(this).parents('tr')).data();
    var vCode = $(this).parents('tr').attr('code');

    if (action == "BtnChangeChartOfAccount") {
      swal
        .fire({
          title:
            "¿La Cuenta cambiará de estado en la partida doble solo para el registro del comprobante?",
          text: "Los cambios no afectan al Plan de Cuentas global",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, cambiar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false,          
        })
        .then(function (result) {
          if (result.value) {
            $.ajax({
              url: globalURLCirculo + "update/voucherChangeTAccount/",
              type: "POST",
              data: { vCodVoucher: vCode },
              success: function (data) {
                //alert(data);
                if (data == "success") {
                  swal.fire(
                    "¡Actualizado!",
                    "La Cuenta T se ha modificado correctamente",
                    "success"
                  )
                  .then(function () {
                      location.reload();
                    });
                } else if (data == "error-taccount") {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10003 ERR-UPDATE {VOUCHER CHARTOFACCOUNT INVALID STATUS DOUBLE MATCH} ",
                    "warning"
                  );
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10001 ERR-UPDATE {VOUCHER  CHARTOFACCOUNT DOUBLE MATCH} ",
                    "warning"
                  );
                }
              },
            });
          }
        });
    }    

    if (action == "BtnDelete") {
      swal
        .fire({
          title:
            "¿Quieres eliminar el comprobante?",
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
              url: globalURLCirculo + "delete/voucher/",
              type: "POST",
              data: { vCodVoucher: vCode },
              success: function (data) {
                if (data == "success") {
                  swal
                    .fire(
                      "¡Eliminado!",
                      "El comprobante se ha eliminado del sistema",
                      "success"
                    )
                    .then(function () {
                      location.reload();
                    });
                } else {
                  swal.fire(
                    "¡UPS!",
                    "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10000 ERR-DELETE {VOUCHER} ",
                    "warning"
                  );
                }
              },
            });
          }
        });
    }

});



var handleVoucherList = $('#datatable_voucherList').DataTable({
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
  ],
  "responsive": true,
  "order": [[2, 'asc']],      
  "columnDefs": [            
      {
          "className": "dt-center",
          targets: 0,
      },
      {
          "className": "dt-center",
          "targets": -1,
          "data": null,
          "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnChangeChartOfAccount\"><i class=\"la la-sync\"></i></button>"
      },            
      {
        targets: 5,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "PENDIENTE", class: " badge badge-light-danger" },
            2: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
  ]
});

$("#searchVoucherList").on("keyup", function () {
  handleVoucherList.search(this.value).draw();
});

$('#datatable_voucherList tbody').on( 'click', 'button', function () {

  var action = this.id;
  var data = handleVoucherList.row($(this).parents('tr')).data();
  var vCode = $(this).parents('tr').attr('code');


});



var handleAccountingEntries = $('#datatable_accountingentries').DataTable({
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
  ],
  "responsive": true,
  "order": [[2, 'asc']],      
  "columnDefs": [            
      {
          "className": "dt-center",
          targets: 0,
      },
      {
          "className": "dt-center",
          "targets": -1,
          "data": null,
          "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnEdit\"><i class=\"la la-pencil\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnPrint\"><i class=\"la la-print\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnView\"><i class=\"la la-eye\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnDelete\"><i class=\"la la-trash\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnChangeType\"><i class=\"la la-sync\"></i></button>"
      },            
      {
        targets: 4,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "VACIO", class: " badge badge-light-info" },
            1: { title: "INGRESO", class: " badge badge-light-success" },
            2: { title: "EGRESO", class: " badge badge-light-warning" },
            3: { title: "TRASPASO", class: " badge badge-light-primary" },
          };
          if (typeof status[data] === "undefined") {
            //return data;
            return '<span class="label label-lg font-weight-bold badge badge-light-danger label-inline">¡ERROR!</span>';
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
        targets: 5,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "ERROR", class: " badge badge-light-danger" },
            1: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
  ]
});

$("#searchAccountingEntries").on("keyup", function () {
  handleAccountingEntries.search(this.value).draw();
});

$('#datatable_accountingentries tbody').on( 'click', 'button', function () {

  var action = this.id;
  var data = handleAccountingEntries.row($(this).parents('tr')).data();
  var vCode = $(this).parents('tr').attr('code');
  var vNumAccountingEntrie = $(this).parents('tr').attr('num');
  var vType = $(this).parents('tr').attr('type');

  if(action == "BtnEdit"){
    swal.fire({
          title: "Modificar Asiento Contable",
          html: '<input id="swal-input1" class="swal2-input" placeholder="2024/04/22"><input id="swal-input2" class="swal2-input" placeholder="Glosa del asiento contable">',
          focusConfirm: false,          
          preConfirm: () => {
          return [
              document.getElementById("swal-input1").value,
              document.getElementById("swal-input2").value
          ];
          }
      }).then(function(result) {
          //alert(result.value[1]);
          if (result.value) {
              const vDateAccountingSeat = result.value[0];
              const vDescAccountingSeat = result.value[1];
              swal.fire({
                title: "¿Está seguro de modificar los datos generales del asiento contalble?",
                text: "Esta acción modificara los registros",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, modificar!",
                cancelButtonText: "No",
                reverseButtons: true,
                allowOutsideClick: false,
                allowEscapeKey: false,                
            }).then(function(result){
                if(result.value){
                    $.ajax({                        
                        type: 'POST',
                        data: {'vCodAccountingSeat':vCode, 'vDateAccountingSeat':vDateAccountingSeat,'vDescAccountingSeat': vDescAccountingSeat}, 
                        url: globalURLCirculo + "update/consolidatedAccountingEntry/",
                        success:function(data){
                            //alert(data);
                            //KTApp.unblockPage();
                            if(data.trim() == 'success'){
                                swal.fire({
                                    title: "Excelente!",
                                    text: "El asiento ha sido modificado correctamente.",
                                    icon: "success"
                                }).then(function(){
                                    window.location = globalURLCirculo + 'finances/accountingEntries';
                                });                                   
                            }
                        }
                    });
                }             
            });                  
            }                    
      });    
  }

  if (action == "BtnPrint") {
    swal
      .fire({
        title:
          "¿Quieres imprimir el Asiento Contable "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al asiento contable",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, imprimir!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.open(globalURLCirculo + 'pdf/accountingSeat/' + vCode + '/' + vNumAccountingEntrie, '_blank', 'noopener, noreferrer');
        }
      });
  }

  if (action == "BtnView") {
    swal
    .fire({
      title:
        "¿Quieres visualizar: " +
        data[2] +
        "?",
      text: "Esta acción te llevará a otra pantalla.",
      icon: "info",
      showCancelButton: true,
      confirmButtonText: "Si!",
      cancelButtonText: "No!",
      reverseButtons: true,
      allowOutsideClick: false,
      allowEscapeKey: false,      
    })
    .then(function (result) {
      if (result.value) {
          window.location = globalURLCirculo + 'finances/accountSeat/' + vCode;
      }
    });
  }
  
  if (action == "BtnDelete") {
    swal
    .fire({
      title:
        "¿Desea eliminar el Asiento Contable de fecha " +data[1] +"?",
      text: "Se borrarán todos los comprobantes asociados al Asiento Contable, por favor verifique antes de realizar la eliminación, esta acción no se puede revertir.",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No!",
      reverseButtons: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
    })
    .then(function (result) {
      if (result.value) {
        $.ajax({
          url: globalURLCirculo + 'delete/accountingSeat/',
          type: "POST",
          data: {'vCodAccountingSeat' : vCode},
          success: function (data) {
            //alert(data);
            if (data == "success") {
              swal
                .fire(
                  "¡Eliminado!",
                  "El Asiento Contable seleccionado junto con todos sus comprobantes asociados se eliminaron correctamente",
                  "success"
                )
                .then(function () {
                  location.reload();
                });
            } else {
              swal.fire(
                "¡UPS!",
                "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10000 ERR-DELETE {ACCOUNTING ENTRIE} ",
                "warning"
              );
            }
          },
        });
      }      
    });
  }

  if (action == "BtnChangeType") {
    swal
      .fire({
        title:
          "¿El Asiento Contable cambiará de Tipo?",
        text: "Esto puede ser modificado en cualquier momento",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, cambiar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,          
      })
      .then(function (result) {
        if (result.value) {
          $.ajax({
            url: globalURLCirculo + "update/accountingEntrieChangeType/",
            type: "POST",
            data: { 'vCodAccountingSeat' : vCode, 'vType' : vType },
            success: function (data) {
              //alert(data);
              if (data == "success") {
                swal.fire(
                  "¡Actualizado!",
                  "El tipo del Asiento Contable se ha modificado correctamente",
                  "success"
                )
                .then(function () {
                    location.reload();
                  });
              }
              /*} else if (data == "error-type") {
                swal.fire(
                  "¡UPS!",
                  "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10003 ERR-UPDATE {ACCOUNTING ENTRIE INVALID STATUS TYPE} ",
                  "warning"
                );
              } else {
                swal.fire(
                  "¡UPS!",
                  "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10001 ERR-UPDATE {ACCOUNTING ENTRIE} ",
                  "warning"
                );
              }*/
            },
          });
        }
      });
  }  

});

var handleAccountSeat = $('#datatable_accountingseat').DataTable({
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
  ],
  "responsive": true,
  "order": [[2, 'asc']],      
  "columnDefs": [            
      {
          "className": "dt-center",
          targets: 0,
      },
      {
          "className": "dt-center",
          "targets": -1,
          "data": null,
          "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnEdit\"><i class=\"la la-pencil\"></i></button>"
      },            
      {
        targets: 6,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "ERROR", class: " badge badge-light-danger" },
            1: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
  ]
});

$("#searchAccountingSeats").on("keyup", function () {
  handleAccountSeat.search(this.value).draw();
});

$('#datatable_accountingseat tbody').on( 'click', 'button', function () {

  var action = this.id;
  var data = handleAccountSeat.row($(this).parents('tr')).data();
  var vCode = $(this).parents('tr').attr('code');

  if (action == "BtnEdit") {
    swal
      .fire({
        title:
          "¿Quieres editar el Comprobante de "+ data[1]+"?",
        text: "Esta acción te llevará a otra pantalla",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,      
      })
      .then(function (result) {
        if (result.value) {
          window.location = globalURLCirculo + 'finances/voucherEdit/' + vCode;
        }
      });
  } 

});


var handleMainAccountingBooksTable = $("#datatable_mainaccountingbooks").DataTable({
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'excelHtml5',
  ],
  responsive: true,
  processing: true,
  ajax: {
    url: globalURLCirculo + "select/dataMainAccountingBooks/",
    method: "POST",
    dataType: "json",
    cache: false,
  },
  columns: [
    { data: "n_codchartofaccounts" },
    { data: "n_chartofaccountname" },
    { data: "c_chartofaccountname" },
    { data: "n_taccount" },
    { data: "n_status" },
    { data: null },
  ],
  columnDefs: [
    {
      targets: -1,
      //"data": null,
      defaultContent:
        '<button class="btn btn-sm btn-clean btn-icon" id="BtnView"><i class="la la-eye"></i></button>',
    },
    {
      width: "75px",
      targets: 3,
      render: function (data, type, full, meta) {
        var status = {
          1: { title: "DEBE", class: " badge badge-light-danger" },
          2: { title: "HABER", class: " badge badge-light-info" },
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

$("#searchMainAccountingBooksTable").on("keyup", function () {
  handleMainAccountingBooksTable.search(this.value).draw();
});

$("#datatable_mainaccountingbooks tbody").on("click", "button", function () {
  var action = this.id;
  var data = handleMainAccountingBooksTable.row($(this).parents("tr")).data();
  //var vCode = $(this).parents('tr').attr('code');

  if (action == "BtnPrint") {
    swal
      .fire({
        title:
          "¿Quieres imprimir el Libro Mayor "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al Plan de Cuentas seleccionado",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, imprimir!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.open(globalURLCirculo + 'pdf/mainAccountingBook/' + data["n_codchartofaccounts"], '_blank', 'noopener, noreferrer');
        }
      });
  }

  if (action == "BtnView") {
    swal
      .fire({
        title:
          "¿Editar el Libro Mayor "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al Plan de Cuentas seleccionado",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.location = globalURLCirculo + 'finances/editMainAccountingBook/' + data["n_codchartofaccounts"];
        }
      });
  }  

});





var handleMainAccountingBooksTable2 = $("#datatable_mainaccountingbooks2").DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "responsive": true,
    "order": [[1, 'asc']],      
    "columnDefs": [            
        {
            "className": "dt-center",
            targets: 0,
        },
        {
            "className": "dt-center",
            "targets": -1,
            "data": null,
            "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnEdit\"><i class=\"la la-pencil\"></i></button>"
        },            
        {
          targets: 7,
          render: function (data, type, full, meta) {
            var status = {
              0: { title: "ERROR", class: " badge badge-light-danger" },
              1: { title: "CONTABILIZADO", class: " badge badge-light-info" },
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
    ]
  });

$("#searchMainAccountingBooksTable2").on("keyup", function () {
  handleMainAccountingBooksTable2.search(this.value).draw();
});

$("#datatable_mainaccountingbooks2 tbody").on("click", "button", function () {
  var action = this.id;
  var data = handleMainAccountingBooksTable2.row($(this).parents("tr")).data();
  //var vCode = $(this).parents('tr').attr('code');

  /*if (action == "BtnPrint") {
    swal
      .fire({
        title:
          "¿Quieres imprimir el Libro Mayor "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al Plan de Cuentas seleccionado",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, imprimir!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.open(globalURLCirculo + 'pdf/mainAccountingBook/' + data["n_codchartofaccounts"], '_blank', 'noopener, noreferrer');
        }
      });
  }

  if (action == "BtnView") {
    swal
      .fire({
        title:
          "¿Editar el Libro Mayor "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al Plan de Cuentas seleccionado",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.location = globalURLCirculo + 'finances/editMainAccountingBook/' + data["n_codchartofaccounts"];
        }
      });
  } */ 

});


var handleIncomeStatementTable = $("#datatable_incomestatement").DataTable({
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'excelHtml5',
  ],
  responsive: true,
  processing: true,
  columnDefs: [
    {
      targets: -1,
      "data": null,
      defaultContent:
        '<button class="btn btn-sm btn-clean btn-icon" id="BtnSelectReport"><i class="la la-sync"></i></button>',
    },
    /*{
      width: "75px",
      targets: 3,
      render: function (data, type, full, meta) {
        var status = {
          1: { title: "DEBE", class: " badge badge-light-danger" },
          2: { title: "HABER", class: " badge badge-light-info" },
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
    },*/
  ],
});

$("#searchIncomeStatement").on("keyup", function () {
  handleIncomeStatementTable.search(this.value).draw();
});

$("#datatable_incomestatement tbody").on("click", "button", function () {
  var action = this.id;
  var data = handleIncomeStatementTable.row($(this).parents("tr")).data();
  //var vCode = $(this).parents('tr').attr('code');

  if (action == "BtnPrint") {
    swal
      .fire({
        title:
          "¿Quieres imprimir el Libro Mayor "+ data[2]+"?",
        text: "Visualizarás todos los comprobantes asociados al Plan de Cuentas seleccionado",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, imprimir!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.open(globalURLCirculo + 'pdf/mainAccountingBook/' + data["n_codchartofaccounts"], '_blank', 'noopener, noreferrer');
        }
      });
  }

});

var handleReceiptList = $('#datatable_receiptList').DataTable({
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
  ],
  "responsive": true,
  "order": [[2, 'asc']],      
  "columnDefs": [            
      {
          "className": "dt-center",
          targets: 0,
      },
      {
          "className": "dt-center",
          "targets": -1,
          "data": null,
          "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnPrint\"><i class=\"la la-print\"></i></button>"
      },            
      {
        targets: 7,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "PENDIENTE", class: " badge badge-light-danger" },
          };
          if (typeof status[data] === 0) {}
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
        targets: 8,
        render: function (data, type, full, meta) {
          var status = {
            1: { title: "Activo", class: " badge badge-light-success" },
            2: { title: "¡ERROR!", class: " badge badge-light-danger" },
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
  ]
});

$("#searchReceiptList").on("keyup", function () {
  handleReceiptList.search(this.value).draw();
});

$('#datatable_receiptList tbody').on( 'click', 'button', function () {

  var action = this.id;
  var data = handleReceiptList.row($(this).parents('tr')).data();
  var vCode = $(this).parents('tr').attr('code');

  if (action == "BtnPrint") {
    swal
      .fire({
        title:
          "¿Quieres imprimir el Recibo "+ data[2] + " del Socio " + data[3] + "?",
        text: "Esta acción te llevará a otra pantalla",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, imprimir!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          window.open(globalURLCirculo + 'pdf/pdfReceipt/' + vCode, '_blank', 'noopener, noreferrer');
        }
      });
  }

});

var handleSumsAndBalancesTable = $('#datatable_sumsandbalances').DataTable({
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  },
  "buttons": [
      'print',
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
  ],
  "responsive": true,
  "order": [[1, 'asc']],      
  "columnDefs": [            
      {
          "className": "dt-center",
          targets: 0,
      },
      {
          "className": "dt-center",
          "targets": -1,
          "data": null,
          "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnConsolidate\"><i class=\"la la-tags\"></i></button>"
      },            
      {
        targets: 7,
        render: function (data, type, full, meta) {
          var status = {
            0: { title: "PENDIENTE", class: " badge badge-light-danger" },
          };
          if (typeof status[data] === 0) {}
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
  ]
});

$("#searchSumsAndBalances").on("keyup", function () {
  handleSumsAndBalancesTable.search(this.value).draw();
});

$('#datatable_sumsandbalances tbody').on( 'click', 'button', function () {

  var action = this.id;
  var data = handleSumsAndBalancesTable.row($(this).parents('tr')).data();
  var vCode = $(this).parents('tr').attr('code');
  var vTotalSaldoDebe = $(this).parents('tr').attr('vTotalSaldoDebe');
  var vTotalSaldoHaber = $(this).parents('tr').attr('vTotalSaldoHaber');
  var vCodChartOfAccount = $(this).parents('tr').attr('vCodChartOfAccount');
  var vMonth = $(this).parents('tr').attr('vMonth');
  var vTAccount = $(this).parents('tr').attr('vTAccount');

  var vMonthLiteral ='';
  if(vMonth == 1){
    vMonthLiteral = 'Enero';
  } else if(vMonth == 2){
    vMonthLiteral = 'Febrero';
  } else if(vMonth == 3){
    vMonthLiteral = 'Marzo';
  } else if(vMonth == 4){
    vMonthLiteral = 'Abril';
  } else if(vMonth == 5){
    vMonthLiteral = 'Mayo';
  } else if(vMonth == 6){
    vMonthLiteral = 'Junio';
  } else if(vMonth == 7){
    vMonthLiteral = 'Julio';
  } else if(vMonth == 8){
    vMonthLiteral = 'Agosto';
  } else if(vMonth == 9){
    vMonthLiteral = 'Septiembre';
  } else if(vMonth == 10){
    vMonthLiteral = 'Octubre';                            
  } else if(vMonth == 11){
    vMonthLiteral = 'Noviembre';
  } else if(vMonth == 12){
    vMonthLiteral = 'Diciembre';        
  }   


  if (action == "BtnConsolidate") {
    swal
      .fire({
        title:
          "Los saldos del <strong>Libro Mayor " + data[2] + "</strong> se Consolidarán en saldos iniciales del <strong>Mes Próximo</strong>",
        text: "Por favor verifica los datos correctamente",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, Consolidar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,        
      })
      .then(function (result) {
        if (result.value) {
          $.ajax({
            url: globalURLCirculo + "insert/consolidateBalance/",
            type: "POST",
            data: { 'vTotalSaldoDebe' : vTotalSaldoDebe, 'vTotalSaldoHaber' : vTotalSaldoHaber, 'vCodChartOfAccount' : vCodChartOfAccount, 'vMonth' : vMonth, 'vTAccount' : vTAccount },
            success: function (data) {
              alert(data);
              if (data == "success") {
                Swal.fire(
                  "¡CONSOLIDADO!",
                  "El Saldo del Libro Mayor se Consolidó correctamente para el Mes Próximo ",
                  "success"
                );
              } else if (data == "exists") {
                Swal.fire({
                  title: '¡CUIDADO!',
                  text: "Ya existe un Saldo Inicial Consolidado para el Mes Próximo",
                  icon: 'error',
                  confirmButtonText: 'ok'
                });
              }
            },
          });          
          //window.open(globalURLCirculo + 'pdf/pdfReceipt/' + vCode, '_blank', 'noopener, noreferrer');
        }
      });
  }

});

  return {
    //main function to initiate the module
    init: function () {
      handleChartOfAccountTable();
      handleBillsTable();
      handleVoucherAccountingSeatTable();
      handleAccountingEntries();
      handleAccountSeat();
      handleMainAccountingBooksTable();
      handleMainAccountingBooksTable2();
      handleSumsAndBalancesTable();
      handleIncomeStatementTable();
      handleReceiptList();
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  DTFinances.init();
});
