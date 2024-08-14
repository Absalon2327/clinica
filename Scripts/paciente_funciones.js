cargar_datos();
console.log("Esta funcionando");
let ninio = "";
let adultos = "";

let fr_adulto = 0;
let fr_niño = 0;
//activamos el boton del menu lateral 
document.getElementById('menu_pacientes').classList.add('active');

//hacer que la modal no se cierre al precionar fuera de ella
//$('#preparar').modal({ backdrop: 'static', keyboard: false });

//validaciones de los campos adulto
$('#registrar_paciente_ad').validate({
    rules: {
        dui_paciente_ad: {
            required: true
        },
        nombre_paciente_ad: {
            required: true
        },
        apellido_paciente_ad: {
            required: true
        },
        fecha_paciente: {
            required: true
        },
        direccion_paciente_ad: {
            required: true
        },
        telefono_paciente_ad: {
            required: true,
            minlength: 9
        },
    },

    messages: {
        dui_paciente_ad: {
            required: "Por favor completa este campo",
            minlength: "Tu dui debe tener 10 caracteres"
        },
        nombre_paciente_ad: {
            required: "Por favor completa este campo"
        },
        apellido_paciente_ad: {
            required: "Por favor completa este campo"
        },
        fecha_paciente: {
            required: "Por favor completa este campo"
        },
        direccion_paciente_ad: {
            required: "Por favor completa este campo"
        },
        telefono_paciente_ad: {
            required: "Por favor completa este campo",
            minlength: "Tu teléfono debe tener 9 caracteres"
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

//validaciones de los campos niño
$('#registrar_paciente_nino').validate({
    rules: {
        nombre_paciente_nino: {
            required: true
        },
        apellido_paciente_nino: {
            required: true
        },
        fecha_paciente_nino: {
            required: true
        },
        edad_paciente_nino: {
            required: true
        },
        nombre_paciente_en: {
            required: true
        },
        direccion_en_paciente: {
            required: true
        },
        telefono_en_paciente: {
            required: true,
            minlength: 9
        },
    },

    messages: {
        nombre_paciente_nino: {
            required: "Por favor completa este campo"
        },
        apellido_paciente_nino: {
            required: "Por favor completa este campo"
        },
        fecha_paciente_nino: {
            required: "Por favor completa este campo"
        },
        edad_paciente_nino: {
            required: "Por favor completa este campo"
        },
        nombre_paciente_en: {
            required: "Por favor completa este campo"
        },
        direccion_en_paciente: {
            required: "Por favor completa este campo"
        },
        telefono_en_paciente: {
            required: "Por favor completa este campo",
            minlength: "Tu telefono debe tener más de 9 caracteres"
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
    $(document).on("submit", "#registrar_paciente_ad", function (e) {
        e.preventDefault();
        var datos = $("#registrar_paciente_ad").serialize();
        console.log("Imprimiendo datos: ", datos);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL GUARDAR", json);

            if (json[0] == "Exito adulto") {
                console.log("respuesta: ", json);
                $("#registrar_paciente_ad").trigger('reset');
                $('#md_paciente').modal('hide');
                $('#nuevo_paciente_d').val("insertar_ad");
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Guardado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            } else if (json[0] == "Exito") {
                $("#registrar_paciente_ad").trigger('reset');
                $('#md_paciente').modal('hide');
                $('#nuevo_paciente_d').val("insertar_ad");
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Modificado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            }
            else if (json[0] == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El paciente: ' + json[1] + ", no se ha modificado"
                });
            } else if (json[0] == "Error Paciente") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El dui: ' + json[1] + ", ya ha sido registrada previamente."
                });
            } else if (json[0] == "Error Paciente2") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El teléfono: ' + json[1] + ", ya ha sido registrada previamente."
                });
            } else if (json[0] == "Error adulto") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El paciente: ' + json[1] + ", ya ha sido registrado previamente. Por Favor verifique si está inactivo"
                });
            }


        });
    });

    $(document).on("submit", "#registrar_paciente_nino", function (e) {
        e.preventDefault();
        var datos = $("#registrar_paciente_nino").serialize();
        console.log("Imprimiendo datos: ", datos);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL GUARDAR: ", json);

            if (json[0] == "Exito nino") {
                $("#registrar_paciente_nino").trigger('reset');
                $('#md_paciente').modal('hide');
                $('#nuevo_paciente_n').val("insertar_nino");
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Guardado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            } else if (json[0] == "Exito ninoo") {
                $("#registrar_paciente_nino").trigger('reset');
                $('#md_paciente').modal('hide');
                $('#nuevo_paciente_n').val("insertar_nino");
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Modificado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            } else if (json[0] == "Error nino") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El paciente: ' + json[1] + ", ya ha sido registrado previamente. Por Favor verifique si está inactivo"
                });
            } else if (json[0] == "Error nino2") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El encargado: ' + json[1] + ", ya ha sido registrada previamente."
                });
            }

        });
    });

    $(document).on("click", ".btn_inactivar", function (e) {
        e.preventDefault();
        var id_paciente = $(this).attr("data-id");
        var datos = { action: "invalidar", id: id_paciente };
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            if (json[0] == "Exito") {
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Inactivado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
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

    $(document).on("click", ".btn_nuevo", function (e) {


        e.preventDefault();
        $("#registrar_paciente_ad").trigger('reset');
        $("#registrar_paciente_nino").trigger('reset');
        $('#btn_guardar').empty().html('Guardar Paciente');
        $('#exampleModalLabel4').empty().html('Nuevo Paciente');

        //ACTIVANDO FORMS NIÑO Y ADULTO

        console.log("frn: " + fr_niño, "fra: " + fr_adulto);

        if (fr_adulto == 0 && fr_niño == 0) {
            //CONFIGURACIÓN ORIGINAL
            $('#btn_tab_adulto').addClass('active');
            $('#navs-top-adultos').addClass("active");
            $('#navs-top-adultos').addClass("show");


            $('#btn_tab_nino').removeClass('active');
            $('#navs-top-ninios').removeClass('show');
            $('#navs-top-ninios').removeClass('active');

        } else if (fr_adulto == 1 && fr_niño == 0) {

            $('#btn_tab_adulto').addClass('active');
            $('#navs-top-adultos').addClass("active");
            $('#navs-top-adultos').addClass("show");
            $('#btn_tab_nino').css("display", "block");

        } else if (fr_adulto == 0 && fr_niño == 1) {

            $('#btn_tab_adulto').css("display", "block");
            $('#btn_tab_nino').removeClass('active');
            $('#navs-top-ninios').removeClass('active');
            $('#navs-top-ninios').removeClass('show');
            $('#btn_tab_adulto').addClass('active');
            $('#navs-top-adultos').addClass("active");
            $('#navs-top-adultos').addClass("show");
            $('#btn_tab_nino').css("display", "block");
        }

        $('#md_paciente').modal('show');


    });

    //----- Funcion para Activar los pacientes -------//
    $(document).on("click", ".btn_activar", function (e) {
        e.preventDefault();
        var id_paciente = $(this).attr("data-id");
        var datos = { action: "activar", id: id_paciente };
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            if (json[0] == "Exito") {
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Reactivado con éxito!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
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

    //----- Funcion para modificar los pacientes adultos-------//
    $(document).on("click", ".btn_modificar", function (e) {

        e.preventDefault();
        var id = $(this).attr("data-idpaciente");
        console.log("El id es: ", id);
        var datos = { "consultar_info": "si_coneste_id", "id": id }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {

                $('#id_paciente').val(id);
                $('#nuevo_paciente_d').val("si_actualizalo");
                $('#dui_paciente_ad').val(json[2]['dui_paciente']);
                $('#nombre_paciente_ad').val(json[2]['nombre_paciente']);
                $('#apellido_paciente_ad').val(json[2]['apellido_paciente']);
                $('#fecha_paciente').val(json[2]['fecha_paciente']);
                $('#direccion_paciente_ad').val(json[2]['direccion_paciente']);
                $('#telefono_paciente_ad').val(json[2]['tel_paciente']);
                $('#sexo_paciente_ad').val(json[2]['sexo_paciente']);
                $('#exampleModalLabel4').empty().html('Modificar Paciente');

                $('#btn_guardar').empty().html('Modificar Paciente');


                //BLOQUEANDO FR NIÑO
                $('#btn_tab_nino').css("display", "none");
                $('#btn_tab_nino').removeClass('active');
                $('#navs-top-ninios').removeClass('active');
                $('#navs-top-ninios').removeClass('show');
                fr_niño = 0;

                //HABILITANDO FR ADULTO
                $('#btn_tab_adulto').css("display", "block");
                $('#btn_tab_adulto').addClass('active');
                $('#navs-top-adultos').addClass('active');
                $('#navs-top-adultos').addClass('show');
                fr_adulto = 1;


            }

        }).fail(function () {

        }).always(function () {

        });
    });

    //----- Funcion para modificar los pacientes niños-------//
    $(document).on("click", ".btn_modificar_nino", function (e) {

        e.preventDefault();
        var id = $(this).attr("data-idpaciente");
        console.log("El id es: ", id);
        var datos = { "consultar_info": "si_coneste_id", "id": id }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL consultar especifico", json);
            if (json[0] == "Exito") {
                $('#id_paciente_n').val(id);
                $('#nuevo_paciente_n').val("si_actualizaloo");
                $('#nombre_paciente_en').val(json[2]['nombres_encargado']);
                $('#nombre_paciente_nino').val(json[2]['nombre_paciente']);
                $('#apellido_paciente_nino').val(json[2]['apellido_paciente']);
                $('#fecha_paciente_nino').val(json[2]['fecha_paciente']);
                $('#direccion_en_paciente').val(json[2]['direccion_paciente']);
                $('#telefono_en_paciente').val(json[2]['tel_paciente']);
                $('#sexo_paciente_nino').val(json[2]['sexo_paciente']);
                $('#select_parentesco_nino').val(json[2]['parentesco_nino']);
                $('#exampleModalLabel4').empty().html('Modificar Paciente');
                $('#btn_guardar_nino').empty().html('Modificar Paciente');



                //BLOQUEANDO FR ADULTO
                $('#btn_tab_adulto').removeClass('active');
                $('#navs-top-adultos').removeClass("active");
                $('#navs-top-adultos').removeClass("show");
                $('#btn_tab_adulto').css("display", "none");
                fr_adulto = 0;

                //HABILITANDO FR NIÑO 
                $('#btn_tab_nino').css("display", "block");
                $('#btn_tab_nino').addClass('active');
                $('#navs-top-ninios').addClass('active');
                $('#navs-top-ninios').addClass('show');
                fr_niño = 1;

                $('#md_paciente').modal('show');
            }

        }).fail(function () {

        }).always(function () {

        });
    });

    //----- Funcion para preparar los pacientes -------//
    $(document).on("submit", "#formulario_registro_cita_preparar", function (e) {
        e.preventDefault();
        $id_paciente = document.getElementById('idpaciente').value;
        $presion = document.getElementById('presion_p').value;
        $temperatura = document.getElementById("temperatura_p").value;
        $altura = document.getElementById('altura_p').value;
        $peso = document.getElementById('peso_p').value;

        var datos = { 'consulta_datos': "insertar", 'idpaciente': $id_paciente, 'presion': $presion, 'temperatura': $temperatura, 'altura': $altura, 'peso': $peso };
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../controladores/paciente_controlador.php',
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
                $('#btn_guardar_p').empty().html('Guardar datos');
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente',
                    text: 'Guardado con éxtio!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        cargar_datos();
                    } else
                        ;
                });
            } else if (json[0] == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Paciente',
                    text: 'El Paciente: ' + json[0] + ", no se pudo preparar. Por Favor verifique si está inactivo"
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
        url: '../../controladores/paciente_controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar", json);
        $("#cantidad_Pacientes").empty().html(json[3]);
        if (json[0] == "Exito") {
            $("#tabla_paciente_a").empty().html(json[1]);
            $("#tabla_paciente_n").empty().html(json[2]);
            $("#tabla_paciente_i").empty().html(json[9]);

        } else if (json[0] == "Error activas ninios") {

            console.log("los ninios estásn malos");

        } else if (json[0] == "Error activas") {

            console.log("los adultos estásn malos");

        } else if (json[0] == "Error inactivas") {

            console.log("los inactivos");

        }
        $('#tabla_paciente_adulto').DataTable({
            "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
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

        $('#tabla_paciente_nin').DataTable({
            "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
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

        $('#tabla_paciente_inactivo').DataTable({
            "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
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
            } else if ($datos.error == "Error") {
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

//----- Funcion para abrir modal de preparar paciente y agregar campos -------//
$(document).on("click", ".btn_preparar", function (e) {
    e.preventDefault();
    var dui = $(this).attr("data-duipaciente");
    var id_paciente = $(this).attr("data-idpaciente");
    $('#idpaciente').val(id_paciente);
    var preparada = $(this).attr("data-preparada");
    var id = $(this).attr("data-id");
    $('#dui_preparar').val(dui);

});

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
//--------- funcion para Validacion de fecha ----------//
function validarfecha() {
    $today = new Date();
    $fecha = document.getElementById("fecha_paciente").value;
    $tipo = document.getElementById("tipo_paciente").value;

    //console.log($fecha);

    $fecha2 = document.getElementById("fecha_paciente_nino").value;
    $tipo_p = document.getElementById("t_paciente").value;
    console.log('tipo_p: ', $tipo_p);

    $year0 = $fecha[0]; $year4 = $fecha2[0];
    $year1 = $fecha[1]; $year5 = $fecha2[1];
    $year2 = $fecha[2]; $year6 = $fecha2[2];
    $year3 = $fecha[3]; $year7 = $fecha2[3];

    console.log('fecha2: ', $fecha2);

    $year = $year0 + $year1 + $year2 + $year3;

    $year2 = $year4 + $year5 + $year6 + $year7;

    console.log($year2);
    $edad = $today.getFullYear() - $year;
    $edad_nino = $today.getFullYear() - $year2;
    console.log($edad_nino);
    //if () {
    if ($edad < 18 && $tipo == "adulto" && $("#navs-top-adultos").is(':visible') == true) {
        document.getElementById("fecha_paciente").value = "";
        toastr.error("Ingrese una fecha valida para el adulto", "Advertencia", {
            positionClass: "toast-top-right",
            timeOut: 3500,
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
            tapToDismiss: !1
        })
    } else if ($edad >= 18 && $tipo === "adulto") {
        document.getElementById('edad_paciente').value = $edad;
    }
    //} else if ($("#navs-top-ninios").is(':visible') == true) {
    if ($edad_nino >= 18 && $tipo_p == "ninio" && $("#navs-top-ninios").is(':visible') == true) {
        document.getElementById("fecha_paciente_nino").value = "";
        toastr.error("Ingrese una fecha valida para el niño", "Advertencia", {
            positionClass: "toast-top-right",
            timeOut: 3500,
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
            tapToDismiss: !1
        })

    } else if ($edad < 18 && $tipo == "ninio") {
        document.getElementById('edad_paciente').value = $edad;

    } else if ($edad_nino < 18 && $tipo_p === "ninio") {
        $('#edad_paciente_nino').val($edad_nino);

    }
    //}
}
//--------- funcion para Validacion de fecha ----------//

// ---- Validacion de Telefono con respecto al '-'---- //
function validacionTelefono() {
    $telefono = document.getElementById("telefono_paciente_ad").value;

    if ($telefono.length == 4 || ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-")) {
        if ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-") {
            $telefono = $telefono.slice(0, $telefono.length - 1) + "-" + $telefono.slice($telefono.length - 1);
            document.getElementById("telefono_paciente_ad").value = $telefono;
        } else {
            $telefono = $telefono + "-";
            document.getElementById("telefono_paciente_ad").value = $telefono;
        }
    } else if ($telefono.length == 5) {
        document.getElementById("telefono_paciente_ad").value = $telefono.substring(0, $telefono.length - 1);
    }
}

function validacionTelefono2() {
    $telefono = document.getElementById("telefono_en_paciente").value;

    if ($telefono.length == 4 || ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-")) {
        if ($telefono.length == 5 && $telefono.charAt($telefono.length - 1) != "-") {
            $telefono = $telefono.slice(0, $telefono.length - 1) + "-" + $telefono.slice($telefono.length - 1);
            document.getElementById("telefono_en_paciente").value = $telefono;
        } else {
            $telefono = $telefono + "-";
            document.getElementById("telefono_en_paciente").value = $telefono;
        }
    } else if ($telefono.length == 5) {
        document.getElementById("telefono_en_paciente").value = $telefono.substring(0, $telefono.length - 1);
    }
}

// ---- Validacion de Telefono con respecto al '-'---- //

// ---- Validacion de DUI con respecto al '-'---- //
function validacionDui() {
    $dui = document.getElementById("dui_paciente_ad").value;

    if ($dui.length == 8 || ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-")) {
        if ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-") {
            $dui = $dui.slice(0, $dui.length - 1) + "-" + $dui.slice($dui.length - 1);
            $("#dui_paciente_ad").val($dui);
        } else {
            $dui = $dui + "-";
            $("#dui_paciente_ad").val($dui);
        }
    } else if ($dui.length == 9) {
        document.getElementById("dui_paciente_ad").value = $dui.substring(0, $dui.length - 1);
    }
}

function validacionDui2() {
    $dui = document.getElementById("dui_en_paciente").value;

    if ($dui.length == 8 || ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-")) {
        if ($dui.length == 9 && $dui.charAt($dui.length - 1) != "-") {
            $dui = $dui.slice(0, $dui.length - 1) + "-" + $dui.slice($dui.length - 1);
            $("#dui_en_paciente").val($dui);
        } else {
            $dui = $dui + "-";
            $("#dui_en_paciente").val($dui);
        }
    } else if ($dui.length == 9) {
        document.getElementById("dui_en_paciente").value = $dui.substring(0, $dui.length - 1);
    }
}

function validarDuifinal() {
    $dui = document.getElementById("dui_paciente_ad").value;

    if ($dui.length == 10) {
        validarduibase();
    }
}
// ---- Validacion de DUI con respecto al '-'---- //

//--- Validar si el DUI esta en la base de datos ---//
function validarduibase() {
    $dui = document.getElementById("dui").value;

    var datos = { action: "verificardui", dui: $dui };
    $respuesta = $.ajax({
        method: "POST",
        url: "../controller/user_controller.php",
        data: datos,
    })
        .done(function (json) {
            $datos = JSON.parse(json);
            if ($datos.error == "Exito") {
                document.getElementById("dui").style.borderColor = "blue";
                $("#duivalidado").val("validado");
            } else if ($datos.error == "Error") {
                document.getElementById("dui").style.borderColor = "red";
                $("#duivalidado").val("");
                toastr.error("El DUI ya existe...", "Información", {
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
        })
        .fail(function (json) { })
        .always(function (json) { });
}
//--- Validar si el DUI esta en la base de datos ---//

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

//----- Funcion para abrir modal de editar paciente y agregar campos -------//
$(document).on("click", ".btn_editar", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-idpaciente");
    var dui = $(this).attr("data-dui");
    var nombre = $(this).attr("data-nombre");
    var apellido = $(this).attr("data-apellido");
    var telefono = $(this).attr("data-telefono");
    var fecha = $(this).attr("data-fecha");
    var direccion = $(this).attr('data-direccion');




    $('#nombre_paciente_ad').val(nombre);
    $('#apellido_paciente_ad').val(apellido);
    $('#dui_paciente_ad').val(dui);
    $('#telefono_paciente_ad').val(telefono);
    $('#fecha_paciente').val(fecha);
    $('#direccion_paciente_ad').val(direccion);
    $('#id_paciente').val(id);
    $('#exampleModalLabel4').empty().html('Modificar Paciente');
    $('#btn_guardar').empty().html('Modificar Paciente');
    $('#update').val('activa');
});