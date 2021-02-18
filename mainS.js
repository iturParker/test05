$(document).ready(function(){
    tablaService = $("#tablaService").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-justifi'><div class='btn-group'><button class='btn btn-primary btnEditarS' id=btnEdicion>Editar</button><button class='btn btn-danger btnBorrarS' id=btnEliminar>Eliminar</button></div></div>"
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

$("#btnNuevoS").click(function(){
    $("#formService").trigger("reset");
    $(".modal-header").css("background-color", "#274742");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Registrar Nuevo Servicio");
    $("#modalCrudS").modal("show");
    id=null;
    opcion = 1; //ALTA
});


//botón EDITAR
$(document).on("click", ".btnEditarS", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    service = fila.find('td:eq(1)').text();
    manager = fila.find('td:eq(2)').text();
    assistant = fila.find('td:eq(3)').text();
    nombreS = fila.find('td:eq(4)').text();
    descripS = fila.find('td:eq(5)').text();
    normS = fila.find('td:eq(6)').text();
    timeS = fila.find('td:eq(7)').text();
    accredS = fila.find('td:eq(8)').text();
    obsS = fila.find('td:eq(9)').text();
    costU = parseInt(fila.find('td:eq(10)').text());

    $("#service").val(service);
    $("#manager").val(manager);
    $("#assistant").val(assistant);
    $("#nombreS").val(nombreS);
    $("#descripS").val(descripS);
    $("#normS").val(normS);
    $("#timeS").val(timeS);
    $("#accredS").val(accredS);
    $("#obsS").val(obsS);
    $("#costU").val(costU);
    opcion = 2; //EDICION

    $(".modal-header").css("background-color", "#71918B");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edicion de Registro de Servicio");
    $("#modalCrudS").modal("show");


});

//botón BORRAR
$(document).on("click", ".btnBorrarS", function(){
    fila = $(this);
    nombreS = $(this).closest("tr").find('td:eq(4)').text();
    opcion = 3 //ELIMINACION
    var respuesta = confirm("¿Seguro desea ELIMINAR a "+ nombreS +"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudS.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, nombreS:nombreS},
            success: function(){
                tablaService.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});

$("#formService").submit(function(e){
    e.preventDefault();
    service = $.trim($("#service").val());
    manager = $.trim($("#manager").val());
    assistant = $.trim($("#assistant").val());
    nombreS = $.trim($("#nombreS").val());
    descripS = $.trim($("#descripS").val());
    normS = $.trim($("#normS").val());
    timeS = $.trim($("#timeS").val());
    accredS = $.trim($("#accredS").val());
    obsS = $.trim($("#obsS").val());
    costU = parseInt($.trim($("#costU").val()));

    $.ajax({
        url: "bd/crudS.php",
        type: "POST",
        dataType: "json",
        data: {service:service, manager:manager, assistant:assistant, nombreS:nombreS, descripS:descripS, normS:normS, timeS:timeS, accredS:accredS, obsS:obsS, costU:costU, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            service = data[0].service;
            manager = data[0].manager;
            assistant = data[0].assistant;
            nombreS = data[0].nombreS;
            descripS = data[0].descripS;
            normS = data[0].normS;
            timeS = data[0].timeS;
            accredS = data[0].accredS;
            obsS = data[0].obsS;
            costU = data[0].costU;
            if(opcion == 1){tablaService.row.add([id,service,manager,assistant,nombreS,descripS,normS,timeS,accredS,obsS,costU]).draw();}
            else{tablaService.row(fila).data([id,service,manager,assistant,nombreS,descripS,normS,timeS,accredS,obsS,costU]).draw();}
        }
    });
    $("#modalCrudS").modal("hide");

    console.log(costU + 500);
});

});
