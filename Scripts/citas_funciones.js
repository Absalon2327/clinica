$(function () {

    //cargar los datos de la tabla y inactivar automaticamente
    var datos = { action: "inactivar_citas"};
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../controladores/Cita_controlador.php',
        data: datos,
    }).done(function (json) {
        if (json[0] == "Exito") {
            cargartablactivas();
        }
    });

    //activamos el boton del menu lateral 
    document.getElementById('menu_citas').classList.add('active');

    $.extend($.validator.messages, {
        required: "Por favor completa este campo"
    });

    //hacer que la modal no se cierre al precionar fuera de ella
    $('#nuevacita').modal({ backdrop: 'static', keyboard: false });

    //hacer que la modal no se cierre al precionar fuera de ella
    $('#preparar').modal({ backdrop: 'static', keyboard: false });

    //validaciones de los campos
    $('#formulario_registro_cita').validate({
        rules: {
            nombre_cita: {
                required: true
            },
            apellido_cita: {
                required: true
            },
            dui_cita: {
                required: true
            },
            telefono_cita: {
                required: true
            },
            fechahora_cita: {
                required: true
            },
        },

        messages: {
            nombre_cita: {
                required: "Por favor completa este campo"
            },
            apellido_cita: {
                required: "Por favor completa este campo"
            },
            dui_cita: {
                required: "Por favor completa este campo"
            },
            telefono_cita: {
                required: "Por favor completa este campo"
            },
            fechahora_cita: {
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

    //Estilos de la tabla
    $('#tabla_citas').DataTable({
        "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        responsive: true,
    });

    $('#tabla_citasInactivas').DataTable({
        "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        responsive: true,
    });

    function validarfechahora($hora, $dia) {

        var today = new Date();
        // obtener la hora actual
        var hour = today.getHours() + ':' + today.getMinutes();

        if ($hora >= '08:00' && $hora <= '14:00') {
            if (today.getDate() == $dia) {
                if ($hora > hour) {
                    return true;
                } else {
                    return false;
                }
            } else if ($dia > today.getDate()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    $(document).on("submit", "#formulario_registro_cita", function (e) {
        e.preventDefault();

        $id_cita = document.getElementById('id_cita').value;
        $update = document.getElementById('update').value;
        $id = document.getElementById('id_paciente').value;
        $fechahora = document.getElementById("fechahora_cita").value;

        $hora = $fechahora.slice(11, $fechahora.length);
        $dia = $fechahora.slice(8, $fechahora.length - 6);

        if (validarfechahora($hora, $dia)) {
            if ($update != 'activa') {
                var datos = { nueva_cita: "insertar", id_paciente: $id, fechahora_cita: $fechahora };
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: '../../controladores/Cita_controlador.php',
                    data: datos,
                }).done(function (json) {
                    if (json[0] == "Exito") {
                        $("#formulario_registro_cita").trigger('reset');
                        $('#nuevacita').modal('hide');
                        $('#id_paciente').val('');
                        $('#id_cita').val('');
                        $('#update').val('');
                        cargartablactivas();
                        Swal.fire({
                            icon: 'success',
                            title: 'Cita',
                            text: 'Almacenada con éxtio!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    } else if (json[0] == "Error cita") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cita',
                            text: 'La Cita: ' + json[1] + ", ya ha sido registrada previamente. Por Favor verifique si está inactiva"
                        });
                    }
                });
            } else {
                var datos = { cambiar_cita: "modificar", id_cita: $id_cita, fechahora_cita: $fechahora };
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: '../../controladores/Cita_controlador.php',
                    data: datos,
                }).done(function (json) {
                    if (json[0] == "Exito") {
                        $("#formulario_registro_cita").trigger('reset');
                        $('#nuevacita').modal('hide');
                        cargartablactivas();
                        document.getElementById('dui_paciente').disabled = false;
                        document.getElementById('buscarP').disabled = false;
                        document.getElementById('nuevoP').disabled = false;
                        $('#nombre_cita').val('');
                        $('#apellido_cita').val('');
                        $('#dui_cita').val('');
                        $('#telefono_cita').val('');
                        $('#telefono_cita').val('');
                        $('#id_cita').val('');
                        $('#id_paciente').val('');
                        $('#id_cita').val('');
                        $('#update').val('');
                        $('#titulo').empty().html('Nueva Cita');
                        $('#btn_guardar').empty().html('Guardar cita');

                        Swal.fire({
                            icon: 'success',
                            title: 'Cita',
                            text: 'Modificada con éxtio!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    } else if (json[0] == "Error cita") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cita',
                            text: 'La Cita: ' + json[1] + ", ya ha sido registrada previamente. Por Favor verifique si está inactiva"
                        });
                    }
                });
            }
        } else {
            toastr.error("Error en la hora", "Cita", {
                positionClass: "toast-top-right",
                timeOut: 2500,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1,
            });
        }
    });

    $(document).on("submit", "#formulario_registro_cita_preparar", function (e) {
        e.preventDefault();
        $id_expediente = document.getElementById('id_expediente').value;
        $id_cita = document.getElementById('id_cita').value;
        $presion = document.getElementById('presion_p').value;
        $temperatura = document.getElementById("temperatura_p").value;
        $altura = document.getElementById('altura_p').value;
        $peso = document.getElementById('peso_p').value;
        $update = document.getElementById('update').value;

        if ($update != 'activa') {
            var datos = { consulta_datos: "insertar", id_expediente: $id_expediente, id_cita: $id_cita, presion: $presion, temperatura: $temperatura, altura: $altura, peso: $peso };
            $.ajax({
                dataType: "json",
                method: "POST",
                url: '../../controladores/Cita_controlador.php',
                data: datos,
            }).done(function (json) {
                if (json[0] == "Exito") {
                    $("#formulario_registro_cita_preparar").trigger('reset');
                    $('#preparar').modal('hide');
                    $('#id_paciente').val('');
                    $('#presion_p').val('');
                    $('#temperatura_p').val('');
                    $('#altura_p').val('');
                    $('#peso_p').val('');
                    $('#dui_preparar').val('');
                    $('#id_cita').val('');
                    $('#update').val('');
                    $('#btn_guardar_p').empty().html('Guardar datos');
                    cargartablactivas();
                    Swal.fire({
                        icon: 'success',
                        title: 'Cita',
                        text: 'Cita preparada con éxtio!',
                        showConfirmButton: false,
                        timer: 2500
                    });
                } else if (json[0] == "Error cita") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cita',
                        text: 'La Cita: ' + json[1] + ", no se pudo preparar. Por Favor verifique si está inactiva"
                    });
                }
            });
        } else {
            var datos = { consulta_datos: "modificar", id_cita: $id_cita, presion: $presion, temperatura: $temperatura, altura: $altura, peso: $peso };
            $.ajax({
                dataType: "json",
                method: "POST",
                url: '../../controladores/Cita_controlador.php',
                data: datos,
            }).done(function (json) {
                if (json[0] == "Exito") {
                    $("#formulario_registro_cita_preparar").trigger('reset');
                    $('#preparar').modal('hide');
                    $('#id_paciente').val('');
                    $('#presion_p').val('');
                    $('#temperatura_p').val('');
                    $('#altura_p').val('');
                    $('#peso_p').val('');
                    $('#dui_preparar').val('');
                    $('#id_cita').val('');
                    $('#update').val('');
                    $('#btn_guardar_p').empty().html('Guardar datos');
                    cargartablactivas();
                    Swal.fire({
                        icon: 'success',
                        title: 'Cita',
                        text: 'Datos modificados con éxtio!',
                        showConfirmButton: false,
                        timer: 2500
                    });
                } else if (json[0] == "Error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cita',
                        text: 'La modificacion: ' + json[1] + ", no se pudo ejecutar. Por Favor verifique si está inactiva"
                    });
                }
            });
        }
    });


});

// ---- Validacion de Telefono con respecto al '-'---- //
function validacionTelefono() {
    $telefono = document.getElementById("telefono_cita").value;

    if ($telefono.length == 4 || ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-")) {
        if ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-") {
            $telefono = $telefono.slice(0, $telefono.length - 1) + "-" + $telefono.slice($telefono.length - 1);
            document.getElementById("telefono_cita").value = $telefono;
        } else {
            $telefono = $telefono + "-";
            document.getElementById("telefono_cita").value = $telefono;
        }
    } else if ($telefono.length == 5) {
        document.getElementById("telefono_cita").value = $telefono.substring(0, $telefono.length - 1);
    }
}
// ---- Validacion de Telefono con respecto al '-'---- //

// ---- Validacion de DUI con respecto al '-'---- //
function validacionDui() {
    $dui = document.getElementById("dui_cita").value;

    if ($dui.length == 8 || ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-")) {
        if ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-") {
            $dui = $dui.slice(0, $dui.length - 1) + "-" + $dui.slice($dui.length - 1);
            $("#dui_cita").val($dui);
        } else {
            $dui = $dui + "-";
            $("#dui_cita").val($dui);
        }
    } else if ($dui.length == 9) {
        document.getElementById("dui_cita").value = $dui.substring(0, $dui.length - 1);
    }
}

function validacionDuiP() {
    $dui = document.getElementById("dui_paciente").value;

    if ($dui.length == 8 || ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-")) {
        if ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-") {
            $dui = $dui.slice(0, $dui.length - 1) + "-" + $dui.slice($dui.length - 1);
            $("#dui_paciente").val($dui);
        } else {
            $dui = $dui + "-";
            $("#dui_paciente").val($dui);
        }
    } else if ($dui.length == 9) {
        document.getElementById("dui_paciente").value = $dui.substring(0, $dui.length - 1);
    }
}


function validarDuifinal() {
    $dui = document.getElementById("dui_cita").value;

    if ($dui.length == 10) {
        validarduibase();
    }
}
// ---- Validacion de DUI con respecto al '-'---- //

//----- Funcion para buscar pacientes ---- //
function Buscarpaciente() {
    $dui = document.getElementById("dui_paciente").value;

    if ($dui.length == 10) {
        var datos = { action: "verificardui", dui: $dui };
        $.ajax({
            method: "POST",
            url: '../../controladores/Cita_controlador.php',
            data: datos,
        }).done(function (json) {
            $datos = JSON.parse(json);
            if ($datos.error == "Exito") {
                $('#id_paciente').val($datos.id);
                $('#nombre_cita').val($datos.nombre);
                $('#apellido_cita').val($datos.apellido);
                $('#dui_cita').val($datos.dui);
                $('#telefono_cita').val($datos.telefono);
                toastr.info("Paciente encontrado", "Busqueda", {
                    positionClass: "toast-top-right",
                    timeOut: 2500,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1,
                });
            } else if ($datos.error == "Pendiente") {
                toastr.error("El paciente ya tiene cita activa", "Busqueda", {
                    positionClass: "toast-top-right",
                    timeOut: 2500,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1,
                });
            } else if ($datos.error == "SinExpediente") {
                $('#nuevoP').text('Nuevo expediente');
                $('#nuevoP').val('Nuevo expediente');

                toastr.error("Debe tener un expediente", "Busqueda", {
                    positionClass: "toast-top-right",
                    timeOut: 2500,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1,
                });
            } else if ($datos.error == "Error") {
                $('#nuevoP').text('Nuevo paciente');
                $('#nuevoP').val('Nuevo paciente');
                toastr.error("No se ha encontrado registro", "Busqueda", {
                    positionClass: "toast-top-right",
                    timeOut: 2500,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1,
                });
            }

        });
    } else {
        toastr.error("Ingrese un DUI valido", "Información", {
            positionClass: "toast-top-right",
            timeOut: 2500,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1,
        });
    }
}
//----- Funcion para buscar pacientes ---- //

/* Funcion para reedireccionar al registro faltante, Nuevo paciente o expediente */

function redirection() {

    var content = document.getElementById('nuevoP').value;
    console.log(content);
    if (content == 'Nuevo paciente') {
        location.href = '../paciente/index.php'
    } else {
        location.href = '../expediente/index.php'
    }
}

/* Funcion para reedireccionar al registro faltante, Nuevo paciente o expediente */

// ---- Validacion de Campos de tipo texto ---- //
function soloLetras(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
        especiales = [8, 37, 39, 46],
        tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
// ---- Validacion de Campos de tipo texto ---- //


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
// ---- Validacion de Campos de tipo numericos ---- //

//----- Funcion para abrir modal de editar cita y agregar campos -------//
$(document).on("click", ".btn_editar", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var nombre = $(this).attr("data-nombre");
    var apellido = $(this).attr("data-apellido");
    var dui = $(this).attr("data-dui");
    var telefono = $(this).attr("data-telefono");

    document.getElementById('dui_paciente').disabled = true;
    document.getElementById('buscarP').disabled = true;
    document.getElementById('nuevoP').disabled = true;

    $('#nombre_cita').val(nombre);
    $('#apellido_cita').val(apellido);
    $('#dui_cita').val(dui);
    $('#telefono_cita').val(telefono);
    $('#id_cita').val(id);
    $('#titulo').empty().html('Modificar Cita');
    $('#btn_guardar').empty().html('Modificar cita');
    $('#update').val('activa');
    $('#dui_paciente').val('');
});
//----- Funcion para abrir modal de editar cita y agregar campos -------//

//----- Funcion que valida el contenido de la modal nuevacita al cerrarla -------//
$(document).on("click", ".btn_cerrar", function (e) {
    e.preventDefault();
    var id_cita = document.getElementById('id_cita').value;
    if (id_cita != "") {
        document.getElementById('dui_paciente').disabled = false;
        document.getElementById('buscarP').disabled = false;
        document.getElementById('nuevoP').disabled = false;

        $('#nombre_cita').val('');
        $('#apellido_cita').val('');
        $('#dui_cita').val('');
        $('#telefono_cita').val('');
        $('#telefono_cita').val('');
        $('#id_cita').val('');
        $('#titulo').empty().html('Nueva Cita');
        $('#btn_guardar').empty().html('Guardar cita');
        $('#update').val('');
    }
});

$(document).on("click", ".btn_cerrar_up", function (e) {
    e.preventDefault();
    var id_cita = document.getElementById('id_cita').value;
    if (id_cita != "") {
        document.getElementById('dui_paciente').disabled = false;
        document.getElementById('buscarP').disabled = false;
        document.getElementById('nuevoP').disabled = false;

        $('#nombre_cita').val('');
        $('#apellido_cita').val('');
        $('#dui_cita').val('');
        $('#telefono_cita').val('');
        $('#telefono_cita').val('');
        $('#id_cita').val('');
        $('#titulo').empty().html('Nueva Cita');
        $('#btn_guardar').empty().html('Guardar cita');
        $('#update').val('');
    }
});
//----- Funcion que valida el contenido de la modal nuevacita al cerrarla -------//

//----- Funcion para abrir modal de preparar paciente y agregar campos -------//
$(document).on("click", ".btn_preparar", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var idex = $(this).attr("data-idex");
    var dui = $(this).attr("data-dui");
    var preparada = $(this).attr("data-preparada");

    if (preparada == 1) {
        var datos = { action: "verificar_consulta", id_cita: id, id_expediente: idex };
        $.ajax({
            method: "POST",
            url: '../../controladores/Cita_controlador.php',
            data: datos,
        }).done(function (json) {
            $datos = JSON.parse(json);
            if ($datos.error == "Exito") {
                $('#presion_p').val($datos.presion);
                $('#temperatura_p').val($datos.temp);
                $('#altura_p').val($datos.altura);
                $('#peso_p').val($datos.peso);
                $('#dui_preparar').val(dui);
                $('#id_cita').val(id);
                $('#update').val('activa');
                $('#btn_guardar_p').empty().html('Modificar datos');
            } else if ($datos.error == "Error") {
                $("#formulario_registro_cita_preparar").trigger('reset');
                $('#preparar').modal('hide');
                toastr.error("ha ocurrido un error", "Busqueda", {
                    positionClass: "toast-top-right",
                    timeOut: 2500,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1,
                });
            }

        });
    } else {
        $('#dui_preparar').val(dui);
        $('#id_cita').val(id);
        $('#id_expediente').val(idex);
    }


});
//----- Funcion para abrir modal de preparar paciente y agregar campos -------//

//----- Funcion que valida el contenido de la modal preparar al cerrarla -------//
$(document).on("click", ".btn_cerrar_p", function (e) {
    e.preventDefault();
    $('#presion_p').val('');
    $('#temperatura_p').val('');
    $('#altura_p').val('');
    $('#peso_p').val('');
    $('#dui_preparar').val('');
    $('#id_cita').val('');
    $('#update').val('');
    $('#btn_guardar_p').empty().html('Guardar datos');

});

$(document).on("click", ".btn_cerrar_up_p", function (e) {
    e.preventDefault();
    $('#presion_p').val('');
    $('#temperatura_p').val('');
    $('#altura_p').val('');
    $('#peso_p').val('');
    $('#dui_preparar').val('');
    $('#id_cita').val('');
    $('#update').val('');
    $('#btn_guardar_p').empty().html('Guardar datos');
});
//----- Funcion que valida el contenido de la modal preparar al cerrarla -------//

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

/* const usuario = [{"general":"9.0","recom":"92%"}];
// Solo asigna el valor a una variable:
let numero = usuario[0].recom.replace(/[%]/g,"");
console.log(numero); */

//----- Funciones para validar el contenido de la modal preparar -----//

//----- Funcion para Inactivar las citas -------//
$(document).on("click", ".btn_inactivar", function (e) {
    e.preventDefault();
    var id_cita = $(this).attr("data-id");

    var datos = { action: "invalidar", id: id_cita };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../controladores/Cita_controlador.php',
        data: datos,
    }).done(function (json) {
        if (json[0] == "Exito") {
            cargartablactivas();
            Swal.fire({
                icon: 'success',
                title: 'Cita',
                text: '¡Inactivada con éxito!',
                showConfirmButton: false,
                timer: 2500
            });
        } else if (json[0] == "Error") {
            toastr.error("Ha ocurrido un error al modificar", "Modificación", {
                positionClass: "toast-top-right",
                timeOut: 2500,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1,
            });
        }

    });
});
//----- Funcion para Inactivar las citas -------//

//----- Funcion para Activar las citas -------//
$(document).on("click", ".btn_activar", function (e) {
    e.preventDefault();
    var id_cita = $(this).attr("data-id");

    var datos = { action: "activar", id: id_cita };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../controladores/Cita_controlador.php',
        data: datos,
    }).done(function (json) {
        if (json[0] == "Exito") {
            cargartablactivas();
            document.getElementById('btn_activa').classList.add('active');
            document.getElementById('btn_inactiva').classList.remove('active');
            Swal.fire({
                icon: 'success',
                title: 'Cita',
                text: '¡Activada con éxito!',
                showConfirmButton: false,
                timer: 2500
            });
        } else if (json[0] == "Error") {
            toastr.error("Ha ocurrido un error al modificar", "Modificación", {
                positionClass: "toast-top-right",
                timeOut: 2500,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1,
            });
        }

    });
});
//----- Funcion para Activar las citas -------//

//--------------- Cargar tabla --------------------//

function cargartablactivas() {
    $('#tabla').val('activas');
    /* document.getElementById('buscar_fecha').disabled = false; */
    //funcion para sacar la ficha actual si no se manda ninguna
    /*  if ($fecha == "") {
         $hoy = new Date();
         $mes = $hoy.getMonth();
         $mes++;
         $fecha = $hoy.getFullYear() + "-" + $mes;
     } */

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("tablaCitas").innerHTML = xmlhttp.responseText;
            $("#tabla_citas").DataTable();
        }
    };

    xmlhttp.open("GET", "./../../Vistas/tablas/tabla_citasactivas.php", true);
    xmlhttp.send();
}
//--------------- Cargar tabla --------------------//


//--------------- Cargar tabla --------------------//

function cargartablainactivas() {
    $('#tabla').val('inactivas');
    /* document.getElementById('buscar_fecha').disabled = true; */

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("tablaCitas").innerHTML = xmlhttp.responseText;
            $("#tabla_citas").DataTable();
        }
    };
    xmlhttp.open("GET", "./../../Vistas/tablas/tabla_citasinactivas.php", true);
    xmlhttp.send();
}
  //--------------- Cargar tabla --------------------//