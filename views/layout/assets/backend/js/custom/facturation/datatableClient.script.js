"use strict";
// var DTClients = (function () {
  var globalURLCirculo = localStorage.getItem(globalURLCirculo);
  globalURLCirculo= "http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/";

  
  var handleDataTableClient= $("#datatable_cli").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    responsive: true,
    processing: true,
    ajax: {
      url: globalURLCirculo + "select/dataClients",
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
      { data: "nombre_rsocial" },
      { data: "apellidos_sigla" },
      { data: "id_documento" },
      { data: "nit_ci" },
      { data: "correo" },
      { data: "movil" },
      { data: "direccion" },
      { data: "descripcion" },
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

  
//   // #myInput is a <input type="text"> element
//   $("#searchPartners").on("keyup", function () {
//     handleDataTablePartners.search(this.value).draw();
//   });

//   $("#datatable_partners tbody").on("click", "button", function () {
//     var action = this.id;
//     var data = handleDataTablePartners.row($(this).parents("tr")).data();

//     if (action == "BtnFinancesRecordPartner") {
//       swal
//         .fire({
//           title:
//             "¿Quieres visualizar el historial financiero del Socio "+ data['t_nombres']+" con el Círculo de la Unión?",
//           text: "Visualizarás todos los pagos del socio seleccionado",
//           icon: "info",
//           showCancelButton: true,
//           confirmButtonText: "Si, Visualizar!",
//           cancelButtonText: "No, cancelar!",
//           reverseButtons: true,
//           allowOutsideClick: false,
//           allowEscapeKey: false,        
//         })
//         .then(function (result) {
//           if (result.value) {
//             //window.open(globalURLCirculo + 'pdf/accountingSeat/' + vCode + '/' + vNumAccountingEntrie, '_blank', 'noopener, noreferrer');
//             //window.location = globalURLCirculo + 'partners/partnersDebts/' + data['n_codpartner'];
//             window.location = globalURLCirculo + 'partners/financesRecordPartner/' + data['n_codpartner'];
//           }
//         });
//     }

//     if (action == "BtnDeletePartner") {
//       swal
//         .fire({
//           title:
//             "¿Quieres eliminar al Socio: " +
//             data["t_nombres"] +
//             " del sistema?",
//           text: "Esta acción es irreversible, por favor ten cuidado.",
//           icon: "info",
//           showCancelButton: true,
//           confirmButtonText: "Si, Eliminar!",
//           cancelButtonText: "No, cancelar!",
//           reverseButtons: true,
//         })
//         .then(function (result) {
//           if (result.value) {
//             $.ajax({
//               url: globalURLCirculo + "delete/partner/",
//               type: "POST",
//               data: { vCodPartner: data["n_codpartner"] },
//               success: function (data) {
//                 if (data == "success") {
//                   swal
//                     .fire(
//                       "Deleted!",
//                       "El socio ha sido eliminado del sistema",
//                       "success"
//                     )
//                     .then(function () {
//                       location.reload();
//                     });
//                 } else {
//                   swal.fire(
//                     "¡UPS!",
//                     "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10012 ERR-DELETE {PARTNER} ",
//                     "warning"
//                   );
//                 }
//               },
//             });
//           }
//         });
//     }    

// });  

// var handleDataTableDebts = $("#datatable_debts").DataTable({
//   language: {
//     url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
//   },
//   responsive: true,
//   processing: true,
//   ajax: {
//     url: globalURLCirculo + "select/dataDebts/",
//     method: "POST",
//     dataType: "json",
//     cache: false,
//   },
//   columns: [
//     { data: "n_coddebt" },
//     { data: "n_codpartner" },
//     { data: "n_codchartofaccounts" },
//     { data: "n_typedebt" },
//     { data: "n_month" },
//     { data: "d_debtdate" },
//     { data: "n_debttotal" },
//     { data: "c_debtdesc" },
//     { data: "n_status" },
//     { data: null },
//   ],
//   columnDefs: [
//     {
//       targets: -1,
//       //"data": null,
//       defaultContent:
      
//         '<button class="btn btn-sm btn-clean btn-icon" id="BtnPayOffDebt"><i class="la la-check-circle"></i></button>',
//     },
//     {
//       width: "75px",
//       targets: 3,
//       render: function (data, type, full, meta) {
//         var status = {
//           0: { title: "¡ERROR!", class: " badge badge-light-danger" },
//           1: { title: "Montos Iniciales", class: " badge badge-light-info" },
//           2: { title: "Cuota Mensual", class: " badge badge-light-info" },
//           3: { title: "Cuota Mortuoria", class: " badge badge-light-warning" },
//           4: { title: "Cuota Participación", class: " badge badge-light-success" },
//           5: { title: "Cuota Ingreso", class: " badge badge-light-primary" },
//         };
//         if (typeof status[data] === "undefined") {
//           return data;
//         }
//         return (
//           '<span class="label label-lg font-weight-bold' +
//           status[data].class +
//           ' label-inline">' +
//           status[data].title +
//           "</span>"
//         );
//       },
//     },
//     {
//       width: "75px",
//       targets: 4,
//       render: function (data, type, full, meta) {
//         var status = {
//           1: { title: "Enero", class: " badge badge-light-danger" },
//           2: { title: "Febrero", class: " badge badge-light-danger" },
//           3: { title: "Marzo", class: " badge badge-light-danger" },
//           4: { title: "Abril", class: " badge badge-light-danger" },
//           5: { title: "Mayo", class: " badge badge-light-danger" },
//           6: { title: "Junio", class: " badge badge-light-danger" },
//           7: { title: "Julio", class: " badge badge-light-danger" },
//           8: { title: "Agosto", class: " badge badge-light-danger" },
//           9: { title: "Septiembre", class: " badge badge-light-danger" },
//           10: { title: "Octubre", class: " badge badge-light-danger" },
//           11: { title: "Noviembre", class: " badge badge-light-danger" },
//           12: { title: "Diciembre", class: " badge badge-light-danger" },
//         };
//         if (typeof status[data] === "undefined") {
//           return data;
//         }
//         return (
//           '<span class="label label-lg font-weight-bold' +
//           status[data].class +
//           ' label-inline">' +
//           status[data].title +
//           "</span>"
//         );
//       },
//     },
//   ],
// });

// // #myInput is a <input type="text"> element
// $("#searchDebts").on("keyup", function () {
// handleDataTableDebts.search(this.value).draw();
// });

// $("#datatable_debts tbody").on("click", "button", function () {
//   var action = this.id;
//   var data = handleDataTableDebts.row($(this).parents("tr")).data();

//   if (action == "BtnPayOffDebt") {
//     swal
//       .fire({
//         title:
//           "¿Quiere pagar la deuda?",
//         text: "Esta acción le llevará a otra pantalla",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, pagar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//         allowOutsideClick: false,
//         allowEscapeKey: false,        
//       })
//       .then(function (result) {
//         window.location = globalURLCirculo + 'partners/partnerPayOffDebt/' + data["n_coddebt"];
//       });
//   }

//   if (action == "BtnDeletePartner") {
//     swal
//       .fire({
//         title:
//           "¿Quieres eliminar al Socio: " +
//           data["t_nombres"] +
//           " del sistema?",
//         text: "Esta acción es irreversible, por favor ten cuidado.",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, Eliminar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//       })
//       .then(function (result) {
//         if (result.value) {
//           $.ajax({
//             url: globalURLCirculo + "delete/partner/",
//             type: "POST",
//             data: { vCodPartner: data["n_codpartner"] },
//             success: function (data) {
//               if (data == "success") {
//                 swal
//                   .fire(
//                     "Deleted!",
//                     "El socio ha sido eliminado del sistema",
//                     "success"
//                   )
//                   .then(function () {
//                     location.reload();
//                   });
//               } else {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10012 ERR-DELETE {PARTNER} ",
//                   "warning"
//                 );
//               }
//             },
//           });
//         }
//       });
//   }    

// });

// var handleDataTablePartnerDebts = $('#datatable_partnerdebts').DataTable({
//   "language": {
//       "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
//   },
//   "buttons": [
//       'print',
//       'copyHtml5',
//       'excelHtml5',
//       'csvHtml5',
//       'pdfHtml5',
//   ],
//   "responsive": true,
//   "order": [[2, 'asc']],      
//   "columnDefs": [            
//       {
//           "className": "dt-center",
//           targets: 0,
//       },
//       {
//           "className": "dt-center",
//           "targets": -1,
//           "data": null,
//           "defaultContent": ""
//       },            
//       /*<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnEdit\"><i class=\"la la-pencil\"></i></button>*/
//       {
//         targets: 1,
//         render: function (data, type, full, meta) {
//           var status = {
//             1: { title: "Deuda Activo Presente", class: " badge badge-light-info" },
//             2: { title: "Deuda Emérito Presente", class: " badge badge-light-success" },
//             3: { title: "Deuda Corporativo", class: " badge badge-light-danger" },
//             4: { title: "Deuda Activo Ausente", class: " badge badge-light-warning" },
//             5: { title: "Deuda Emérito Ausente", class: " badge badge-light-primary" },
//             6: { title: "Deuda Especial", class: " badge badge-light-secondary" },
//             7: { title: "Deuda Diplomático", class: " badge badge-light-info" },
//             8: { title: "Deuda Congelado", class: " badge badge-light-success" },
//             9: { title: "Deuda Exento", class: " badge badge-light-danger" },
//             10: { title: "Deuda Concesionario", class: " badge badge-light-warning" },
//             11: { title: "Deuda Emérito No Aportante", class: " badge badge-light-primary" },
//             12: { title: "Deuda Exento", class: " badge badge-light-secondary" },
//             13: { title: "Deuda Mortuoria", class: " badge badge-info" },
//             14: { title: "Deuda Extraordinaria", class: " badge badge-info" },
//             12: { title: "Deuda Otra", class: " badge badge-info" },
//           };
//           if (typeof status[data] === "undefined") {
//             return data;
//           }
//           return (
//             '<span class="label label-lg font-weight-bold' +
//             status[data].class +
//             ' label-inline">' +
//             status[data].title +
//             "</span>"
//           );
//         },
//       },
//       {
//         targets: 6,
//         render: function (data, type, full, meta) {
//           var status = {
//             0: { title: "¡ERROR!", class: " badge badge-light-primary" },
//             1: { title: "PENDIENTE DE PAGO", class: " badge badge-light-danger" },
//             2: { title: "PAGADO", class: " badge badge-light-success" },
//           };
//           if (typeof status[data] === "undefined") {
//             return data;
//           }
//           return (
//             '<span class="label label-lg font-weight-bold' +
//             status[data].class +
//             ' label-inline">' +
//             status[data].title +
//             "</span>"
//           );
//         },
//       },                                      
//   ]
// });

// $("#searchPartnerDebts").on("keyup", function () {
//   handleDataTablePartnerDebts.search(this.value).draw();
// });

// $('#datatable_partnerdebts tbody').on( 'click', 'button', function () {

//   var action = this.id;
//   var data = handleDataTablePartnerDebts.row($(this).parents('tr')).data();
//   var vCode = $(this).parents('tr').attr('code');

//   if (action == "BtnEdit") {
//     swal
//       .fire({
//         title:
//           "¿Quieres editar el Comprobante de "+ data[1]+"?",
//         text: "Esta acción te llevará a otra pantalla",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, editar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//         allowOutsideClick: false,
//         allowEscapeKey: false,      
//       })
//       .then(function (result) {
//         if (result.value) {
//           window.location = globalURLCirculo + 'finances/voucherEdit/' + vCode;
//         }
//       });
//   } 

// });

// var handleRecordFinancesPartnerTable = $('#datatable_recordfinancespartner').DataTable({
//   "language": {
//       "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
//   },
//   "buttons": [
//       'print',
//       'copyHtml5',
//       'excelHtml5',
//       'csvHtml5',
//       'pdfHtml5',
//   ],
//   "responsive": true,
//   "order": [[2, 'asc']],      
//   "columnDefs": [            
//       {
//           "className": "dt-center",
//           targets: 0,
//       },
//       {
//           "className": "dt-center",
//           "targets": -1,
//           "data": null,
//           "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnChangeChartOfAccount\"><i class=\"la la-sync\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnDelete\"><i class=\"la la-trash\"></i></button>"
//       },            
//       {
//         targets: 5,
//         render: function (data, type, full, meta) {
//           var status = {
//             1: { title: "PENDIENTE", class: " badge badge-light-danger" },
//             2: { title: "CONTABILIZADO", class: " badge badge-light-info" },
//           };
//           if (typeof status[data] === "undefined") {
//             return data;
//           }
//           return (
//             '<span class="label label-lg font-weight-bold' +
//             status[data].class +
//             ' label-inline">' +
//             status[data].title +
//             "</span>"
//           );
//         },
//       },                                
//   ]
// });

// $("#searchVoucherAccountingSeats").on("keyup", function () {
//   handleRecordFinancesPartnerTable.search(this.value).draw();
// });

// $('#datatable_recordfinancespartner tbody').on( 'click', 'button', function () {

//   var action = this.id;
//   var data = handleRecordFinancesPartnerTable.row($(this).parents('tr')).data();
//   var vCode = $(this).parents('tr').attr('code');

//   /*if (action == "BtnChangeChartOfAccount") {
//     swal
//       .fire({
//         title:
//           "¿La Cuenta cambiará de estado en la partida doble solo para el registro del comprobante?",
//         text: "Los cambios no afectan al Plan de Cuentas global",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, cambiar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//         allowOutsideClick: false,
//         allowEscapeKey: false,          
//       })
//       .then(function (result) {
//         if (result.value) {
//           $.ajax({
//             url: globalURLCirculo + "update/voucherChangeTAccount/",
//             type: "POST",
//             data: { vCodVoucher: vCode },
//             success: function (data) {
//               //alert(data);
//               if (data == "success") {
//                 swal.fire(
//                   "¡Actualizado!",
//                   "La Cuenta T se ha modificado correctamente",
//                   "success"
//                 )
//                 .then(function () {
//                     location.reload();
//                   });
//               } else if (data == "error-taccount") {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10003 ERR-UPDATE {VOUCHER CHARTOFACCOUNT INVALID STATUS DOUBLE MATCH} ",
//                   "warning"
//                 );
//               } else {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10001 ERR-UPDATE {VOUCHER  CHARTOFACCOUNT DOUBLE MATCH} ",
//                   "warning"
//                 );
//               }
//             },
//           });
//         }
//       });
//   }    

//   if (action == "BtnDelete") {
//     swal
//       .fire({
//         title:
//           "¿Quieres eliminar el comprobante?",
//         text: "Esta acción es irreversible, por favor ten cuidado.",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, Eliminar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//       })
//       .then(function (result) {
//         if (result.value) {
//           $.ajax({
//             url: globalURLCirculo + "delete/voucher/",
//             type: "POST",
//             data: { vCodVoucher: vCode },
//             success: function (data) {
//               if (data == "success") {
//                 swal
//                   .fire(
//                     "¡Eliminado!",
//                     "El comprobante se ha eliminado del sistema",
//                     "success"
//                   )
//                   .then(function () {
//                     location.reload();
//                   });
//               } else {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10000 ERR-DELETE {VOUCHER} ",
//                   "warning"
//                 );
//               }
//             },
//           });
//         }
//       });
//   }*/

// });

// var handlePartnerDebtReconciliation = $('#datatable_partnerdebtreconciliation').DataTable({
//   "language": {
//       "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
//   },
//   "buttons": [
//       'print',
//       'copyHtml5',
//       'excelHtml5',
//       'csvHtml5',
//       'pdfHtml5',
//   ],
//   "responsive": true,
//   "order": [[2, 'asc']],      
//   "columnDefs": [            
//       {
//           "className": "dt-center",
//           targets: 0,
//       },
//       {
//           "className": "dt-center",
//           "targets": -1,
//           "data": null,
//           "defaultContent": "<button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnChangeChartOfAccount\"><i class=\"la la-sync\"></i></button><button class=\"btn btn-sm btn-clean btn-icon\" id=\"BtnDelete\"><i class=\"la la-trash\"></i></button>"
//       },            
//       {
//         targets: 3,
//         render: function (data, type, full, meta) {
//           var status = {
//             0: { title: "¡ERROR!", class: " badge badge-light-danger" },
//             1: { title: "Montos Iniciales", class: " badge badge-light-info" },
//             2: { title: "Cuota Mensual", class: " badge badge-light-info" },
//             3: { title: "Cuota Mortuoria", class: " badge badge-light-warning" },
//             4: { title: "Cuota Participación", class: " badge badge-light-success" },
//             5: { title: "Cuota Ingreso", class: " badge badge-light-primary" },
//           };
//           if (typeof status[data] === "undefined") {
//             return data;
//           }
//           return (
//             '<span class="label label-lg font-weight-bold' +
//             status[data].class +
//             ' label-inline">' +
//             status[data].title +
//             "</span>"
//           );
//         },
//       },
//       {
//         targets: 10,
//         render: function (data, type, full, meta) {
//           var status = {
//             0: { title: "¡ERROR!", class: " badge badge-light-warning" },
//             1: { title: "Pendiente", class: " badge badge-light-danger" },
//             2: { title: "Pagado", class: " badge badge-light-success" },
//           };
//           if (typeof status[data] === "undefined") {
//             return data;
//           }
//           return (
//             '<span class="label label-lg font-weight-bold' +
//             status[data].class +
//             ' label-inline">' +
//             status[data].title +
//             "</span>"
//           );
//         },
//       },      
//   ]
// });

// $("#searchPartnerDebtReconciliation").on("keyup", function () {
//   handlePartnerDebtReconciliation.search(this.value).draw();
// });

// $('#datatable_partnerdebtreconciliation tbody').on( 'click', 'button', function () {

//   var action = this.id;
//   var data = handlePartnerDebtReconciliation.row($(this).parents('tr')).data();
//   var vCode = $(this).parents('tr').attr('code');

//   /*if (action == "BtnChangeChartOfAccount") {
//     swal
//       .fire({
//         title:
//           "¿La Cuenta cambiará de estado en la partida doble solo para el registro del comprobante?",
//         text: "Los cambios no afectan al Plan de Cuentas global",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, cambiar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//         allowOutsideClick: false,
//         allowEscapeKey: false,          
//       })
//       .then(function (result) {
//         if (result.value) {
//           $.ajax({
//             url: globalURLCirculo + "update/voucherChangeTAccount/",
//             type: "POST",
//             data: { vCodVoucher: vCode },
//             success: function (data) {
//               //alert(data);
//               if (data == "success") {
//                 swal.fire(
//                   "¡Actualizado!",
//                   "La Cuenta T se ha modificado correctamente",
//                   "success"
//                 )
//                 .then(function () {
//                     location.reload();
//                   });
//               } else if (data == "error-taccount") {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10003 ERR-UPDATE {VOUCHER CHARTOFACCOUNT INVALID STATUS DOUBLE MATCH} ",
//                   "warning"
//                 );
//               } else {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la actualización, por favor vuelva a intentar o reporte este error Code: 10001 ERR-UPDATE {VOUCHER  CHARTOFACCOUNT DOUBLE MATCH} ",
//                   "warning"
//                 );
//               }
//             },
//           });
//         }
//       });
//   }    

//   if (action == "BtnDelete") {
//     swal
//       .fire({
//         title:
//           "¿Quieres eliminar el comprobante?",
//         text: "Esta acción es irreversible, por favor ten cuidado.",
//         icon: "info",
//         showCancelButton: true,
//         confirmButtonText: "Si, Eliminar!",
//         cancelButtonText: "No, cancelar!",
//         reverseButtons: true,
//       })
//       .then(function (result) {
//         if (result.value) {
//           $.ajax({
//             url: globalURLCirculo + "delete/voucher/",
//             type: "POST",
//             data: { vCodVoucher: vCode },
//             success: function (data) {
//               if (data == "success") {
//                 swal
//                   .fire(
//                     "¡Eliminado!",
//                     "El comprobante se ha eliminado del sistema",
//                     "success"
//                   )
//                   .then(function () {
//                     location.reload();
//                   });
//               } else {
//                 swal.fire(
//                   "¡UPS!",
//                   "Hay un problema con la eliminación, por favor vuelva a intentar o reporte este error Code: 10000 ERR-DELETE {VOUCHER} ",
//                   "warning"
//                 );
//               }
//             },
//           });
//         }
//       });
//   }*/

// });


//   return {
//     //main function to initiate the module
//     init: function () {
//       // handleDataTableClient();
//     },
//   };
// })();
// KTUtil.onDOMContentLoaded(function () {
//   DTClients.init();
// });
