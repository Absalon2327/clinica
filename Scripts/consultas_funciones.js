//activamos el boton del menu lateral 
document.getElementById('menu_consultas').classList.add('active');
cargar_datos();
//esta de mas esto morro jaja
let idex = 0;
let idc = 0;
console.log("Todo está integrado");
$(function () {


    $(document).on("click", ".btn_realizar_consulta", function (e) {

        e.preventDefault();
        let id = $(this).attr("data-expediente");
        location.href = 'nueva_consulta.php?idexpe=' + id;

    });

    $(document).on("click", ".btn_ver_consulta", function (e) {
        e.preventDefault();

        let id = $(this).attr("data-consulta");
        let idexp = $(this).attr("data-expediente");

        idc = id;
        idex = idexp;

        console.log("El id es: ", id);
        let datos = { "consultar_info": "si_coneste_id", "idconsulta": id, "id": idexp }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {


                let edad_paciente;
                //NUM EXPE
                $("#num_expediente_cv").empty().html(json[4]['id_expediente']);

                //DATOS DEL PACIENTE 
                edad_paciente = edad(json[4]['fecha_paciente']);
                $("#nombre_paciente_cv").empty().html(json[4]['nombre_paciente'] + " " + json[4]['apellido_paciente']);
                $("#edad_paciente_cv").empty().html("Edad: " + edad_paciente);
                $("#sexo_paciente_cv").empty().html("Sexo: " + json[4]['sexo_paciente']);


                $("#diagnostico_cv").empty().html(json[4]['diagnostico_consulta']);
                $("#medicamento_recetado_cv").empty().html(json[4]['receta_consulta']);
                $("#monto_consulta_cv").empty().html("$ "+json[4]['monto_consulta']);

                $("#ver_consulta_realizada").modal('show');

            } else if (json[0] != "Exito") {


            }

        }).fail(function () {

        }).always(function () {

        });

    });

    $(document).on("click", ".btn_imprimir", function (e) {

        e.preventDefault();
        console.log("N°: " + idex + "C: " + idc);

        let altura = screen.height;
        let ancho = screen.width;
        let repo = '../reportes/r_consulta_imprimir.php?idexp=' + idex + "&idcons="+idc;

        window.open(repo, "Pagos", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Pagos, width=" + ancho + ", height=" + altura);


    });




});

function cargar_datos() {

    let datos = { "consultar_info": "si_consultala" }

    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Consultas_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#pacientes_prepados").empty().html(json[1]);
        $("#consultas_realizadas").empty().html(json[2]);

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

        $('#tabla_consulta_realizada').DataTable({
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