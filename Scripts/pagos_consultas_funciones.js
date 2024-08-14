let idconsulta = 0;
let idexpediente = 0;
$(function () {

    cargar_datos();

    $(document).on("click", ".btn_facturar", function (e) {
        e.preventDefault();

        let id = $(this).attr("data-consulta");
        idconsulta = $(this).attr("data-consulta");        
        idexpediente = $(this).attr("data-expediente");
        
        console.log("El id es: ", id);
        let datos = { "consultar_info": "si_coneste_id", "idconsulta": id }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Pagos_Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                let edad_paciente;

                $("#idconsulta").val(json[2]['id_consulta']);
                $("#monto_consulta_pago_g").val(json[2]['monto_consulta']);

                let hora = fecha_hora(json[2]['fecha_consulta']);
                let fecha = fecha_hora(json[2]['fecha_consulta']);

                //DATOS DEL PACIENTE 
                edad_paciente = edad(json[2]['fecha_paciente']);
                $("#nombre_paciente_pago").empty().html(json[2]['nombre_paciente'] + " " + json[2]['apellido_paciente']);
                $("#edad_paciente_pago").empty().html("Edad: " + edad_paciente);


                $("#fecha_consulta_pago").empty().html(hora[0]);
                $("#hora_consulta_pago").empty().html(fecha[1]);

                $("#medicamento_recetado_pago").empty().html(json[2]['receta_consulta']);
                $("#monto_consulta_pago").empty().html("$ " + json[2]['monto_consulta']);

                $("#md_pago_consulta").modal("show");

            } else if (json[0] != "Exito") {


            }

        }).fail(function () {

        }).always(function () {

        });

    });

    $(document).on("click", ".btn_inactivar", function (e) {
        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: '¿Esta seguro de Inactivar?',
            text: 'Si Inactiva este registro ya no podrá verlo',

            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "Sí, inactivar",
            cancelButtonText: "Cancelar",
        }).then((resutl) => {
            if (resutl.isConfirmed) {

                e.preventDefault();
                var id = $(this).attr("data-pago");
                console.log("El id es: ", id);
                var datos = { "inactivar_pago": "si_coneste_id", "id": id }

                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: '../../Controladores/Pagos_Consultas_Controlador.php',
                    data: datos,
                }).done(function (json) {
                    console.log("EL consultar especifico", json);
                    if (json[0] == "Exito") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Pagos',
                            text: 'Inactivado con éxtio!',
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
                            title: 'Pagos',
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

        var id = $(this).attr("data-consulta");
        var idexp = $(this).attr("data-expediente");
        console.log("El id es: ", id);
        var datos = { "consultar_info": "si_coneste_id", "idconsulta": id }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Pagos_Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                let edad_paciente;

                $("#idconsulta").val(json[2]['id_consulta']);
                $("#monto_consulta_pago_g").val(json[2]['monto_consulta']);

                let hora = fecha_hora(json[2]['fecha_consulta']);
                let fecha = fecha_hora(json[2]['fecha_consulta']);

                //DATOS DEL PACIENTE 
                edad_paciente = edad(json[2]['fecha_paciente']);
                $("#nombre_paciente_pago").empty().html(json[2]['nombre_paciente'] + " " + json[2]['apellido_paciente']);
                $("#edad_paciente_pago").empty().html("Edad: " + edad_paciente);


                $("#fecha_consulta_pago").empty().html(hora[0]);
                $("#hora_consulta_pago").empty().html(fecha[1]);

                $("#medicamento_recetado_pago").empty().html(json[2]['receta_consulta']);
                $("#monto_consulta_pago").empty().html("$ " + json[2]['monto_consulta']);

                $("#md_pago_consulta").modal("show");

            } else if (json[0] != "Exito") {


            }

        }).fail(function () {

        }).always(function () {

        });

    });

    $(document).on("click", ".btn_verpago", function (e) {

        let id = $(this).attr("data-pago");
        console.log("El id es: ", id);
        let datos = { "consultar_info": "si_coneste_id", "idpago": id }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Pagos_Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                let edad_paciente;


                let hora = fecha_hora(json[3]['fecha_consulta']);
                let fecha = fecha_hora(json[3]['fecha_consulta']);

                //DATOS DEL PACIENTE 
                edad_paciente = edad(json[3]['fecha_paciente']);
                $("#nombre_paciente_pagado").empty().html(json[3]['nombre_paciente'] + " " + json[3]['apellido_paciente']);
                $("#edad_paciente_pagado").empty().html("Edad: " + edad_paciente);


                $("#fecha_consulta_pagado").empty().html(hora[0]);
                $("#hora_consulta_pagado").empty().html(fecha[1]);

                $("#medicamento_recetado_pagado").empty().html(json[3]['receta_consulta']);
                $("#monto_consulta_pagado").empty().html("$ " + json[3]['monto_consulta']);

                $("#md_pagos").modal("show");

            } else if (json[0] != "Exito") {


            }

        }).fail(function () {

        }).always(function () {

        });

    });

    $(document).on("submit", "#fr_registrar_pago", function (e) {
        e.preventDefault();
        let datos = $("#fr_registrar_pago").serialize();
        console.log("Imprimiendo datos: ", datos);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Pagos_Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL GUARDAR", json);

            if (json[0] == "Exito") {
                $("#md_pago_consulta").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Pagos',
                    text: 'Pagado con éxtio!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {

                        let altura = screen.height;
                        let ancho = screen.width;
                        let repo = '../reportes/r_consulta_imprimir.php?idexp=' + idexpediente + "&idcons=" + idconsulta;

                        window.open(repo, "Pagos", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Pagos, width=" + ancho + ", height=" + altura);

                        cargar_datos();
                    } else
                        ;
                });

            } else if (json[0] == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Pagos',
                    text: 'Algo salió mal !'
                });
            }
        });

    });


});

function cargar_datos() {

    var datos = { "consultar_info": "si_consultala" }

    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Pagos_Consultas_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#tabla_consultas_pendientes").empty().html(json[2]);
        $("#tabla_consultas_pagadas").empty().html(json[1]);

        $('#tabla_consulta_pendiente').DataTable({
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
        $('#tabla_consulta_pagada').DataTable({
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

function fecha_hora(date) {

    //divido la feha de la hora
    let fecha_string = date;
    let separacion = fecha_string.split(' ');
    let fecha = separacion[0];
    let hora = separacion[1];
    let fecha_formateada = "";

    //Formteo la fecha
    let porciones_fecha = fecha.split('-');
    let fecha1 = porciones_fecha[2] + "-" + porciones_fecha[1] + "-" + porciones_fecha[0];

    //envio la fecha formateada
    fecha_formateada = fecha1;
    let datetime = [fecha_formateada, hora]
    return datetime;

}
