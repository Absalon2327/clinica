$(function () {
    cargar_datos();

    $(document).on('click', '.btn_ver_registros', function (e) {
        e.preventDefault();


        let id = $(this).attr("data-expediente");
        let idh = $(this).attr("data-historial");
        let datos = { "mostrar_registro_hc": "si_coneste_id", "id": id, "idhc": idh }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/Historial_Clinico_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("actualizar pass", json);
            if (json[0] == "Exito") {

                //NUM EXPE
                $("#num_expediente_hc").empty().html(json[4]['id_expediente']);

                //DATOS DEL PACIENTE 
                $("#nombre_paciente_hc").empty().html(json[4]['paciente']);
                edad_paciente = edad(json[4]['edad']);
                $("#edad_paciente_hc").empty().html(edad_paciente);
                $("#sexo_paciente_hc").empty().html(json[4]['sexo_paciente']);

                if (json[4]['encargado'] === null) {
                    $("#encargado_hc").empty().html("Sin Encargado");
                } else {
                    $("#encargado_hc").empty().html(json[4]['encargado']);
                }

                $("#tabla_registros_hc").empty().html(json[1]);
                $("#ver_historial").modal('show');

                $('#tabla_historiales').DataTable({
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
                        "zeroRecords": "No se encontró",
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

            }
        }).always(function () {

        })
    });

    $(document).on("click", ".btn_eliminar", function (e) {

        Swal.fire({
            icon: 'warning',
            title: '¿Esta seguro de Eliminar este registro?',
            text: 'Si Elimina el este Diagnóstico ya no podrá usarlo',
            target: document.getElementById('ver_historial'),
            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "Sí, Eliminar",
            cancelButtonText: "Cancelar",
        }).then((resutl) => {
            if (resutl.isConfirmed) {

                e.preventDefault();
                let id = $(this).attr("data-historial");
                let idcons = $(this).attr("data-consulta");
                console.log("El id es: ", id);
                let datos = { "elimnar_hc": "si_coneste_id", "id": id, "idconsulta": idcons}

                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: '../../Controladores/Historial_Clinico_Controlador.php',
                    data: datos,
                }).done(function (json) {
                    console.log("EL consultar especifico", json);
                    if (json[0] == "Exito") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Historial Clínico',
                            text: 'Eliminado con éxtio!',
                            confirmButtonText: "Ok",
                        }).then((confirmacion) => {
                            if (confirmacion) {
                                cargar_datos();
                            } else
                                ;
                        });


                    } else if (json[0] != "Exito") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Historial Clínico',
                            text: 'Algo salió mal !'
                        });

                    }

                }).fail(function () {

                }).always(function () {

                });


            } else if (resutl.isDenied) {
                Swal.fire({
                    icon: 'error',
                    title: 'Salidas',
                    text: 'Algo salió mal !'
                });

            }
            ;
        });

    });
});

function cargar_datos() {
    let datos = { "consultar_info": "si_consultala" }

    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Historial_Clinico_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar", json);

        if (json[0] == 'Exito') {

            $("#tabla_adultos_hc").empty().html(json[1]);
            $("#tabla_niños_hc").empty().html(json[2]);

            $('#tabla_historial_adultos').DataTable({
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
                    "zeroRecords": "No se encontró",
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

            $('#tabla_historial_niños').DataTable({
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
                    "zeroRecords": "No se encontró",
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
        } else if (json[0] == 'Error h_adultos') {
            Swal.fire({
                icon: 'error',
                title: 'Historial Clínico',
                text: 'Algo salió mal en los adultos !'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Historial Clínico',
                text: 'Algo salió mal en los niños !'
            });
        }




    }).fail(function () {

    }).always(function () {
        Swal.close();
    });
}

function edad(fecha) {

    let edad = 0;
    let año_actual = new Date().getFullYear();

    //divido la fecha para obtener el año
    let separacion = fecha.split('-');
    año = separacion[0];
    edad = parseInt(año_actual) - parseInt(año);

    return edad;

}