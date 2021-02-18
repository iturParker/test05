$(document).ready(function(){
    tablaCoti = $("#tablaCoti").DataTable({
        //Para cambiar el lenguaje a español
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

$("#btnNuevoC").click(function(){
    $("#formCoti").trigger("reset");
    $(".modal-header").css("background-color", "#274742");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Cotizacion");
    $("#modalCrudC").modal("show");
    id=null;
    opcion = 1; //alta
});

var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
$(document).on("click", ".btnEditarC", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nameClient = fila.find('td:eq(1)').text();
    noClient = fila.find('td:eq(2)').text();
    nameS = fila.find('td:eq(3)').text();
    area = fila.find('td:eq(4)').text();
    descripS = fila.find('td:eq(5)').text();
    normS = fila.find('td:eq(6)').text();
    timeS = fila.find('td:eq(7)').text();
    accredS = fila.find('td:eq(8)').text();
    obsS = fila.find('td:eq(9)').text();
    costU = parseInt(fila.find('td:eq(10)').text());
    cant = parseInt(fila.find('td:eq(11)').text());

    $("#nameClient").val(nameClient);
    $("#noClient").val(noClient);
    $("#nameS").val(nameS);
    $("#area").val(area);
    $("#descripS").val(descripS);
    $("#normS").val(normS);
    $("#timeS").val(timeS);
    $("#accredS").val(accredS);
    $("#obsS").val(obsS);
    $("#costU").val(costU);
    $("#cant").val(cant);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Cotizacion");
    $("#modalCrudC").modal("show");

});

//botón BORRAR
$(document).on("click", ".btnBorrarC", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de Eliminar el numero de Coticacion "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudC.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaCoti.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});

$("#formCoti").submit(function(e){
    e.preventDefault();
    nameClient = $.trim($("#nameClient").val());
    noClient = $.trim($("#noClient").val());
    nameS = $.trim($("#nameS").val());
    area = $.trim($("#area").val());
    descripS = $.trim($("#descripS").val());
    normS = $.trim($("#normS").val());
    timeS = $.trim($("#timeS").val());
    accredS = $.trim($("#accredS").val());
    obsS = $.trim($("#obsS").val());
    costU = parseInt($.trim($("#costU").val()));
    cant = parseInt($.trim($("#cant").val()));
    costT= parseInt(costU * cant);

    $.ajax({
        url: "bd/crudC.php",
        type: "POST",
        dataType: "json",
        data: {nameClient:nameClient, noClient:noClient, nameS:nameS, area:area, descripS:descripS, normS:normS, timeS:timeS, accredS:accredS, obsS:obsS, costU:costU, cant:cant, costT:costT, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            nameClient = data[0].nameClient;
            noClient = data[0].noClient;
            nameS = data[0].nameS;
            area = data[0].area;
            descripS = data[0].descripS;
            normS = data[0].normS;
            timeS = data[0].timeS;
            accredS = data[0].accredS;
            obsS = data[0].obsS;
            costU = data[0].costU;
            cant = data[0].cant;
            costT = data[0].costT;
            if(opcion == 1){tablaCoti.row.add([id,nameClient,noClient,nameS,area,descripS,normS,timeS,accredS,obsS,costU,cant,costT]).draw();}
            else{tablaCoti.row(fila).data([id,nameClient,noClient,nameS,area,descripS,normS,timeS,accredS,obsS,costU,cant,costT]).draw();}
        }
    });
    $("#modalCrudC").modal("hide");
    console.log(cant + 500, costU + 500, costT);

});

});
