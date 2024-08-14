//activamos el boton del menu lateral 
document.getElementById('menu_expediente').classList.add('active');
cargar_datos();
//cargar_datos();



$(function () {

    $('#form_preparar').validate({
        rules: {
            presion_p: {
                required: true
            },
            temperatura_p: {
                required: true,
            },
            altura_p: {
                required: true,
            },
            peso_p: {
                required: true,
            },
        },
        messages: {
            presion_p: {
                required: "Por favor completa este campo"
            },
            temperatura_p: {
                required: "Por favor completa este campo"
            },
            altura_p: {
                required: "Por favor completa este campo"
            },
            peso_p: {
                required: "Por favor completa este campo"
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });



    document.getElementById("expe_activo").onclick = function () {
        if (document.getElementById("expe_activo").checked) {

            cargar_datos("activo");

        } else {
            cargar_datos("inactivo");
        }
    }
    document.getElementById("expe_inactivo").onclick = function () {
        if (document.getElementById("expe_inactivo").checked) {

            cargar_datos("inactivo");

        } else {
            cargar_datos("activo");
        }
    }

    $(document).on("click", "#btn_select_paciente", function (e) {

        e.preventDefault();
        var datos = { "cargar_pacientes": "si_cargalos" }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Expediente_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                $("#tabla_paciente_anadir_ad").empty().html(json[1]);
                $("#tabla_paciente_anadir_ninios").empty().html(json[2]);
                $('#seleccionar_paciente').modal('show');
                estilo_tablas_pacientes();
            }

        }).fail(function () {

        }).always(function () {

        });
    });

    $(document).on("click", ".btn_anadir_expediente", function (e) {

        e.preventDefault();
        let id = $(this).attr("data-idpaciente");
        location.href = 'nuevo_expediente.php?id=' + id;


    });

    $(document).on("click", ".btn_ver", function (e) {

        e.preventDefault();
        let idexpe = $(this).attr("data-idexpediente");
        let idpa = $(this).attr("data-paciente");
        var datos = { "ver_expediente": "si_coneste_id", "id_expe": idexpe, 'idpaciente': idpa }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Expediente_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                let edad_paciente;
                //NUM EXPE
                $("#num_expediente").empty().html(json[2]['id_expediente']);
                $("#idexpedient").val(json[2]['id_expediente']);

                //DATOS DEL PACIENTE 
                $("#nombre_paciente_v").empty().html(json[3]['nombre_paciente']);
                edad_paciente = edad(json[3]['fecha_paciente']);
                $("#edad_paciente_v").empty().html(edad_paciente);
                $("#sexo_paciente_v").empty().html(json[3]['sexo_paciente']);

                if (json[4] === null) {
                    $("#responsable_v").empty().html("Sin Encargado");
                } else {
                    $("#responsable_v").empty().html(json[4]);
                }


                //HEREDITARIOS Y FAMILIARES
                $("#diabetes_v").empty().html(json[2]['diabetes_mellitus']);
                if (json[2]['parentesco_diabetes'] == 'n/a') {
                    $("#p_diabetes_v").empty().html('...');
                } else {
                    $("#p_diabetes_v").empty().html(json[2]['parentesco_diabetes']);
                }


                $("#hipertension_v").empty().html(json[2]['hipertension_arterial']);
                if (json[2]['parentesco_hip_ar'] == 'n/a') {
                    $("#p_hipertension_v").empty().html('...');
                } else {
                    $("#p_hipertension_v").empty().html(json[2]['parentesco_hip_ar']);
                }

                $("#cardiopatia_v").empty().html(json[2]['cardipatia_isquemica']);
                if (json[2]['parentesco_card_isq'] == 'n/a') {
                    $("#p_cardiopatia_v").empty().html('...');
                } else {
                    $("#p_cardiopatia_v").empty().html(json[2]['parentesco_card_isq']);
                }

                $("#cancer_v").empty().html(json[2]['cancer']);
                if (json[2]['parentesco_can'] == 'n/a') {
                    $("#p_cancer_v").empty().html('...');
                } else {
                    $("#p_cancer_v").empty().html(json[2]['parentesco_can']);
                }

                if (json[2]['otro_hereditario'] == 'n/a') {
                    $("#otro_hereditario_v").empty().html('...');
                } else {
                    $("#otro_hereditario_v").empty().html(json[2]['otro_hereditario']);
                }

                $("#tipo_familia_v").empty().html(json[2]['tipo_familia']);
                $("#rol_madre_v").empty().html(json[2]['rol_madre']);
                $("#Familia").empty().html(json[2]['familia']);
                $("#dis_fam_v").empty().html(json[2]['disfunciones_familiares']);

                //PERSONALES NO PATOLÓGICOS
                $("#estado_civil_v").empty().html(json[2]['esado_civil']);
                $("#religion_v").empty().html(json[2]['religion']);
                $("#habitacion_v").empty().html(json[2]['habitacion']);
                $("#ocupacion_v").empty().html(json[2]['ocupacion']);

                if (json[2]['actividad_empresa'] == 'n/a') {
                    $("#rubro_empresa_v").empty().html('...');
                } else {
                    $("#rubro_empresa_v").empty().html(json[2]['actividad_empresa']);
                }
                $("#actividad_fisica_v").empty().html(json[2]['actividad_fisica']);
                $("#escolaridad_v").empty().html(json[2]['escolaridad']);
                $("#alimentacion_v").empty().html(json[2]['alimentacion']);
                $("#higiene_v").empty().html(json[2]['higiene_personal']);

                if (json[2]['tiempo_ocupacion'] == 'n/a') {
                    $("#tiempo_ocupacion_v").empty().html('...');
                } else {
                    $("#tiempo_ocupacion_v").empty().html(json[2]['tiempo_ocupacion']);
                }

                if (json[2]['factores_riesgo_laboral'] == 'n/a') {
                    $("#fact_riesgo_labo_v").empty().html('...');
                } else {
                    $("#fact_riesgo_labo_v").empty().html(json[2]['factores_riesgo_laboral']);
                }

                //PERSONALES PATOLÓGICOS
                $("#patologicos_v").empty().html(json[2]['patologias']);

                //GINECOBSTETRICOS
                $("#menarca_v").empty().html(json[2]['menarca']);
                $("#in_vida_sex_v").empty().html(json[2]['inicio_vida_sexual']);
                if (json[2]['fecha_ultima_menstruacion'] == '0000-00-00') {
                    $("#fech_ult_menst_v").empty().html('...');
                } else {
                    $("#fech_ult_menst_v").empty().html(json[2]['fecha_ultima_menstruacion']);
                }
                $("#num_hijos_v").empty().html(json[2]['num_hijos']);
                if (json[2]['bajo_peso_nacer'] == 'n/a') {
                    $("#bajo_peso_v").empty().html('...');
                } else {
                    $("#bajo_peso_v").empty().html(json[2]['bajo_peso_nacer']);
                }
                $("#num_parejas_v").empty().html(json[2]['num_parejas']);
                $("#num_homo_v").empty().html(json[2]['num_homosexuales']);
                $("#num_embarazos_v").empty().html(json[2]['num_embarazos']);
                $("#num_partos_v").empty().html(json[2]['num_partos']);
                if (json[2]['fecha_ultimo_parto'] == '0000-00-00') {
                    $("#fech_ult_part_v").empty().html('...');
                } else {
                    $("#fech_ult_part_v").empty().html(json[2]['fecha_ultimo_parto']);
                }
                $("#macros_v").empty().html(json[2]['macrosomicos_vivos']);
                $("#num_hete_v").empty().html(json[2]['num_heteros']);
                $("#num_bis_v").empty().html(json[2]['num_bisexuales']);
                
                $("#padecimiento_v").empty().html(json[2]['padecimiento_actual']);

                $("#aparatos_v").empty().html(json[2]['aparatos_sistemas']);

                $("#aux_diag_previo_v").empty().html(json[2]['auxiliares_diagnostico_previo']);

                //MÉTODOS DE PLANIFICACIÓN FAMILIAR

                if (json[2]['metodo_planificacion_familiar'] == 'n/a') {
                    $("#metodo_pf_v").empty().html("...");
                } else {
                    $("#metodo_pf_v").empty().html(json[2]['metodo_planificacion_familiar']);
                }

                //ABRE EL MODAL DEPUÉS DE HABER CARGADO TODOS LOS DATOS
                $('#ver_expediente').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Expediente',
                    text: 'Algo salió mal !'
                });
            }

        }).fail(function () {

        }).always(function () {

        });
    });

    $(document).on("click", ".btn_editar", function (e) {

        e.preventDefault();
        let id = $(this).attr("data-paciente");
        let idexp = $(this).attr("data-idexpediente");
        location.href = 'editar_expediente.php?id=' + id + '&idexp=' + idexp;

    });


    $(document).on("click", ".btn_imprimir", function (e) {

        e.preventDefault();
        let id = $("#idexpedient").val();
        console.log("N°: " + id);

        let altura = screen.height;
        let ancho = screen.width;
        let repo = '../reportes/r_expediente.php?id=' + id;

        window.open(repo, "Expedientes", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Expediente, width=" + ancho + ", height=" + altura);


    });

    $(document).on("click", ".btn_reactivar", function (e) {

        e.preventDefault();
        var id = $(this).attr("data-idexpediente");
        console.log("El id es: ", id);
        var datos = { "reactivar_expediente": "si_coneste_id", "id": id }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Expediente_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                Swal.fire({
                    icon: 'success',
                    title: 'Expedientes',
                    text: 'Activado con éxtio!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos('inactivo');
                    } else
                        ;
                });


            } else if (json[0] != "Exito") {
                Swal.fire({
                    icon: 'error',
                    title: 'Expedientes',
                    text: 'Algo salió mal !'
                });

            }

        }).fail(function () {

        }).always(function () {

        });

    });

    $(document).on("click", ".btn_inactivar", function (e) {

        Swal.fire({
            icon: 'warning',
            title: '¿Esta seguro de Inactivar?',
            text: 'Si Inactiva el Expediente ya no podrá usarlo',

            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "Sí, inactivar",
            cancelButtonText: "Cancelar",
        }).then((resutl) => {
            if (resutl.isConfirmed) {

                e.preventDefault();
                var id = $(this).attr("data-idexpediente");
                console.log("El id es: ", id);
                var datos = { "inactivar_expediente": "si_coneste_id", "id": id }

                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: '../../Controladores/Expediente_Controlador.php',
                    data: datos,
                }).done(function (json) {
                    console.log("EL consultar especifico", json);
                    if (json[0] == "Exito") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Expedientes',
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
                            title: 'Expedientes',
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

    $(document).on("click", ".btn_preparar", function (e) {

        e.preventDefault();
        let idexpe = $(this).attr("data-idexpediente");
        let idpa = $(this).attr("data-paciente");
        var datos = { "ver_expediente": "si_coneste_id", "id_expe": idexpe, 'idpaciente': idpa };

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Expediente_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                let edad_paciente;
                //NUM EXPE
                $("#num_expe_p").empty().html(json[2]['id_expediente']);

                //Para registrar la preparación
                $("#idexpediente").val(json[2]['id_expediente']);
                $("#idpaciente").val(json[2]['id_paciente']);



                //DATOS DEL PACIENTE 
                $("#nombre_paciente_p").empty().html(json[3]['nombre_paciente']);
                edad_paciente = edad(json[3]['fecha_paciente']);
                $("#edad_paciente_p").empty().html(edad_paciente);
                $("#sexo_paciente_p").empty().html(json[3]['sexo_paciente']);
                $('#md_preparar').modal('show');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Expediente',
                    text: 'Algo salió mal !'
                });
            }

        }).fail(function () {

        }).always(function () {

        });
    });

    $(document).on("submit", "#form_preparar", function (e) {
        e.preventDefault();
        var datos = $("#form_preparar").serialize();
        console.log("Imprimiendo datos: ", datos);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/Expediente_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL GUARDAR", json);

            if (json[0] == "Exito") {
                console.log("respuesta: ", json);
                $("#form_preparar").trigger('reset');
                $('#md_preparar').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: 'Expediente',
                    text: 'Paciente preparado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            } else if (json[0] == "Error expediente") {
                Swal.fire({
                    icon: 'error',
                    title: 'Expediente',
                    text: 'Algo salió mal al actualizar el estado del expediente!'
                });
            } else if (json[0] == "Error preparar") {
                Swal.fire({
                    icon: 'error',
                    title: 'Expediente',
                    text: 'Algo salió mal al preparar el paciente!'
                });
            }

        });
    });

});

/*  */



function cargar_datos(estado) {

    var datos = { "consultar_info": "si_consultala", "estado_expe": estado }

    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Expediente_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#expedientes_adultos").empty().html(json[1]);
        $("#expedientes_niños").empty().html(json[2]);

        $('#tabla_expedientes_adultos').DataTable({
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
        $('#tabla_expedientes_ninios').DataTable({
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

function estilo_tablas_pacientes() {
    $('#tabla_paciente_anadir_adulto').DataTable({
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

    $('#tabla_paciente_anadir_nin').DataTable({
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

//----- Funciones para validar el contenido de la modal preparar -----//
function validarprecion() {
    $presion = document.getElementById('presion_p').value;

    if ($presion.length == 3 || ($presion.length == 4 && $presion.charAt($presion.length - 1) != "/")) {
        if ($presion.length == 4 && $presion.charAt($presion.length - 1) != "/") {
            $presion = $presion.slice(0, $presion.length - 1) + "/" + $presion.slice($presion.length - 1);
            document.getElementById("presion_p").value = $presion;
        } else {
            $presion = $presion + "/";
            document.getElementById("presion_p").value = $presion;
        }
    } else if ($presion.length == 4) {
        document.getElementById("presion_p").value = $presion.substring(0, $presion.length - 1);
    }
}

function validartempend() {
    $temp = document.getElementById('temperatura_p').value;

    $temp = $temp + "°C";
    document.getElementById("temperatura_p").value = $temp;
}

function validartempbegi() {
    $temp = document.getElementById('temperatura_p').value;

    $temp = $temp.slice(0, $temp.length - 2);
    document.getElementById("temperatura_p").value = $temp;
}

function validaraltend() {
    $alt = document.getElementById('altura_p').value;

    $alt = $alt + "Mt";
    document.getElementById("altura_p").value = $alt;
}

function validaraltbegi() {
    $alt = document.getElementById('altura_p').value;

    $alt = $alt.slice(0, $alt.length - 2);
    document.getElementById("altura_p").value = $alt;
}

function validarpesoend() {
    $peso = document.getElementById('peso_p').value;

    $peso = $peso + "Kg";
    document.getElementById("peso_p").value = $peso;
}

function validarpesobegi() {
    $peso = document.getElementById('peso_p').value;

    $peso = $peso.slice(0, $peso.length - 2);
    document.getElementById("peso_p").value = $peso;
}

// ---- Validacion de Campos de tipo numericos ---- //
function soloNumeros(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        numeros = "0123456789",
        especiales = [8, 37, 39, 46],
        tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (numeros.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}