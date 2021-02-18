$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-justifi'><div class='btn-group'><button class='btn btn-primary btnEditar' id=btnEdicion>Editar</button><button class='btn btn-danger btnBorrar' id=btnEliminar>Eliminar</button></div></div>"
       }],

// IDEA: lENGUAJE
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });

$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#274742");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Registro de Cliente");
    $("#modalCRUD").modal("show");
    id=null;
    opcion = 1; //ALTA
});

var fila; //VARIABLE DE EDICION Y ELIMINACION


//botón VER
/*$(document).on("click", ".btnVer", function(){
    fila = $(this).closest("tr");
    nombreDelCliente = $(this).closest("tr").find('td:eq(1)').text();

    opcion = 4;


    $(".modal-header").css("background-color", "#3C963B");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Informacion del Cliente");
    $("#modalRead").modal("show");

    alert(nombreDelCliente);
});*/


//botón EDITAR
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombreDelCliente = fila.find('td:eq(1)').text();
    rfc = fila.find('td:eq(2)').text();
    dirFis = fila.find('td:eq(3)').text();
    dirFi = fila.find('td:eq(4)').text();
    nCon1 = fila.find('td:eq(5)').text();
    nCon2 = fila.find('td:eq(6)').text();
    pCon1 = fila.find('td:eq(7)').text();
    pCon2 = fila.find('td:eq(8)').text();
    tCon1 = parseInt(fila.find('td:eq(9)').text());
    tCon2 = parseInt(fila.find('td:eq(10)').text());
    mCon1 = fila.find('td:eq(11)').text();
    mCon2 = fila.find('td:eq(12)').text();
    tPago = fila.find('td:eq(13)').text();
    pPago = fila.find('td:eq(14)').text();

    $("#nombreDelCliente").val(nombreDelCliente);
    $("#rfc").val(rfc);
    $("#dirFis").val(dirFis);
    $("#dirFi").val(dirFi);
    $("#nCon1").val(nCon1);
    $("#nCon2").val(nCon2);
    $("#pCon1").val(pCon1);
    $("#pCon2").val(pCon2);
    $("#tCon1").val(tCon1);
    $("#tCon2").val(tCon2);
    $("#mCon1").val(mCon1);
    $("#mCon2").val(mCon2);
    $("#tPago").val(tPago);
    $("#pPago").val(pPago);
    opcion = 2; //EDICION

    $(".modal-header").css("background-color", "#71918B");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edicion de Registro de Cliente");
    $("#modalCRUD").modal("show");

});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    nombreDelCliente = $(this).closest("tr").find('td:eq(1)').text();
    opcion = 3 //ELIMINACION
    var respuesta = confirm("¿Seguro desea ELIMINAR a "+ nombreDelCliente+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, nombreDelCliente:nombreDelCliente},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});

$("#formPersonas").submit(function(e){
    e.preventDefault();
    nombreDelCliente = $.trim($("#nombreDelCliente").val());
    rfc = $.trim($("#rfc").val());
    dirFis = $.trim($("#dirFis").val());
    dirFi = $.trim($("#dirFi").val());
    nCon1 = $.trim($("#nCon1").val());
    nCon2 = $.trim($("#nCon2").val());
    pCon1 = $.trim($("#pCon1").val());
    pCon2 = $.trim($("#pCon2").val());
    tCon1 = $.trim($("#tCon1").val());
    tCon2 = $.trim($("#tCon2").val());
    mCon1 = $.trim($("#mCon1").val());
    mCon2 = $.trim($("#mCon2").val());
    tPago = $.trim($("#tPago").val());
    pPago = $.trim($("#pPago").val());
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombreDelCliente:nombreDelCliente, rfc:rfc, dirFis:dirFis, dirFi:dirFi, nCon1:nCon1, nCon2:nCon2,pCon1:pCon1,pCon2:pCon2,tCon1:tCon1,tCon2:tCon2,mCon1:mCon1,mCon2:mCon2,tPago:tPago,pPago:pPago, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            nombreDelCliente = data[0].nombreDelCliente;
            rfc = data[0].rfc;
            dirFis = data[0].dirFis;
            dirFi = data[0].dirFi;
            nCon1 = data[0].nCon1;
            nCon2 = data[0].nCon2;
            pCon1 = data[0].pCon1;
            pCon2 = data[0].pCon2;
            tCon1 = data[0].tCon1;
            tCon2 = data[0].tCon2;
            mCon1 = data[0].mCon1;
            mCon2 = data[0].mCon2;
            tPago = data[0].tPago;
            pPago = data[0].pPago;
            if(opcion == 1){tablaPersonas.row.add([id,nombreDelCliente,rfc,dirFis,dirFi,nCon1,nCon2,pCon1,pCon2,tCon1,tCon2,mCon1,mCon2,tPago,pPago]).draw();}
            else{tablaPersonas.row(fila).data([id,nombreDelCliente,rfc,dirFis,dirFi,nCon1,nCon2,pCon1,pCon2,tCon1,tCon2,mCon1,mCon2,tPago,pPago]).draw();}
        }
    });
    $("#modalCRUD").modal("hide");

});

});
