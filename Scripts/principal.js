$(function () {
    cargar_datos();

});

function cargar_datos() {
    //var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../controladores/controlador_Principal.php',
        //data : datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#datos_tabla").empty().html(json[5]);
        $("#cantidad_usuarios").empty().html(json[1]);
        $("#cantidad_Pacientes").empty().html(json[2]);
        $("#cantidad_citas").empty().html(json[3]);
        if (json[9] == 0 || json[9] == 1 || json[9] == null) {
            $("#cantidad_consultas").empty().html('$ 00.00');
        } else {
            $("#cantidad_consultas").empty().html("$ " + json[9]);
        }
        // $("#cantidad_consultas").empty().html(json[9]);
        $('#tabla_ci').DataTable({
            "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            responsive: true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "Sin registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar :",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
        console.log("aqui");
    }).fail(function (response) {
        console.log("Error:", response.responseText)
    }).always(function () {
        Swal.close();
    });


}