
const formulario = document.getElementById('formulario_registro');
const inputs = document.querySelectorAll('#formulario_registro input');
const expresiones = {
    password: /^.{4,12}$/,
}
const validarPassword = (e) => {
    switch (e.target.name) {
        case "contrasenaf":
            if (expresiones.password.test(e.target.value)) {
            } else {

            }
            console.log('Funciona');
            break;
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarPassword);
    input.addEventListener('blur', validarPassword);
});
//validaciones de los campos
$('#formulario_registro').validate({
    rules: {
        nombref: {
            required: true
        },
        usuariof: {
            required: true
        },
        duif: {
            required: true
        },
        contrasenaf: {
            required: true,
            minlength: 6

        },
    },

    messages: {
        nombref: {
            required: "Por favor completa este campo"
        },
        usuariof: {
            required: "Por favor completa este campo"
        },
        duif: {
            required: "Por favor completa este campo"
        },
        contrasenaf: {
            required: "Por favor completa este campo",
            minlength: "Digite 6 caracteres como mínimo"
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
$(function () {
    cargar_datos();
    $(document).on("click", ".btn_cerrar_class", function (e) {
        e.preventDefault();
        $("#formulario_registro").trigger('reset');
        $('#md_registrar_usuario').modal('hide');
    });
    $(document).on("submit", "#formulario_registro", function (e) {
        e.preventDefault();
        var datos = $("#formulario_registro").serialize();
        console.log("Imprimiendo datos: ", datos);
        //mostrar_mensaje("Almacenando información","Por favor no recargue la página");
        if ($("#tipof").val() == "Seleccione") {
            toastr.info("Debe seleccionar el tipo de Empleado", "Usuarios", {
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
        else {
            $.ajax({
                dataType: "json",
                method: "POST",
                url: '../../controladores/controlador_usuarios.php',
                data: datos,
            }).done(function (json) {
                console.log("EL GUARDAR", json);
                if (json[0] == "Exito") {
                    $("#formulario_registro").trigger('reset');
                    $('#md_registrar_usuario').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuarios',
                        text: 'Usuario guardado exito!',
                        confirmButtonText: "Ok",
                    }).then((confirmacion) => {
                        if (confirmacion) {
                            cargar_datos();
                        } else
                            ;
                    });
                } else if (json[1] == "ya existen estos datos de usuario y dui") {
                    toastr.info("Este Dui y nombre de usuario ya pertenece a otro Usuario", "Usuarios", {
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
                } else if (json[1] == "existe usuario") {
                    toastr.info("Este nombre de usuario ya pertenece a otro Usuario", "Usuarios", {
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
                } else if (json[1] == "existe dui") {
                    toastr.info("Este Dui ya pertenece a otro Usuario", "Usuarios", {
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuarios',
                        text: 'Algo salió mal !'
                    });
                }

            }).fail(function (response) {
                console.log("Error:", response.responseText)
            }).always(function () {

            });
        }


    });

    $(document).on("click", ".btn_editar", function (e) {
        var id = $(this).attr("data-idusuario");
        console.log("El id es: ", id);
        var datos = { "consultar_info": "si_condui_especifico", "id": id }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/controlador_usuarios.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                console.log("nombre: ", json[2]['nombre']);
                console.log("usuario: ", json[2]['usuario']);

                $('#llave_persona').val(id);
                $('#ingreso_datos').val("si_actualizalo");
                $('#nombref').val(json[2]['nombre']);
                $('#duif').val(json[2]['dui']);
                $('#tipof').val(json[2]['tipo']);
                $("#usuariof").val(json[2]['usuario']);
                // $('#md_registrar_usuario').empty().html('Modificar Usuario');
                // $('#boton_enviar').empty().html('Modificar usuario');
                $('#contrasenaf').css("display", "none");
                $('#contrasena').css("display", "none");
                $('#md_registrar_usuario').modal('show');
            }
            else {
                console.log("rerspuesta", json);
            }
        }).fail(function () {

        }).always(function () {
            Swal.close();
        });
    });

    $(document).on("click", ".btn_inactivar", function (e) {
        e.preventDefault();
        var idusaurio = $(this).attr("data-idusuario");
        var datos = { action: "invalidar", id: idusaurio };
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/controlador_usuarios.php',
            data: datos,
        }).done(function (json) {
            if (json[0] == "Exito") {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario',
                    text: '¡Inactivado con éxito!',
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

});

function cargar_datos() {

    //var datos = {"consultar_info":"si_consultala"}
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../controladores/controlador_usuarios.php',
        //data : datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#datos_tabla").empty().html(json[1]);
        // $("#cantidad_usuarios").empty().html(json[2]);
        $('#tabla_usuarios').DataTable({
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
    }).fail(function (response) {
        console.log("Error:", response.responseText)
    }).always(function () {
        Swal.close();

    });
    console.log("NO entra");

}

function validacionDui() {
    $dui = document.getElementById("duif").value;

    if ($dui.length == 8 || ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-")) {
        if ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-") {
            $dui = $dui.slice(0, $dui.length - 1) + "-" + $dui.slice($dui.length - 1);
            $("#duif").val($dui);
        } else {
            $dui = $dui + "-";
            $("#duif").val($dui);
        }
    } else if ($dui.length == 9) {
        document.getElementById("duif").value = $dui.substring(0, $dui.length - 1);
    }
}

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


