
$(function () {

    datos_paciente();

    $('#fr_registrar_consulta').validate({
        rules: {
            diagnostico_consulta: {
                required: true
            },
            receta_consulta: {
                required: true
            },
            monto_consulta: {
                required: true
            }
        },

        messages: {
            diagnostico_consulta: {
                required: "Por favor completa este campo"
            },
            receta_consulta: {
                required: "Por favor completa este campo"
            },
            monto_consulta: {
                required: "Digite un monto"
            }
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

    $(document).on("submit", "#fr_registrar_consulta", function (e) {
        e.preventDefault();
        let datos = $("#fr_registrar_consulta").serialize();

        console.log("Imprimiendo datos: ", datos);
        $.ajax({
            dataType: "json",
            method: "POST",
            url: '../../Controladores/Consultas_Controlador.php',
            data: datos,
        }).done(function (json) {
            console.log("EL GUARDAR", json);

            if (json[0] == "Exito") {

                Swal.fire({
                    icon: 'success',
                    title: 'Consulta',
                    text: 'Enviada con éxtio!',
                    confirmButtonText: "Ok",
                }).then((confirmacion) => {
                    if (confirmacion) {
                        $("#fr_registrar_consulta").trigger('reset');
                        $(location).attr('href', 'index.php');
                    } else
                        ;
                });

            } else if (json[0] == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Consulta',
                    text: 'Algo salió mal !'
                });
            }
        });

    });

});


function datos_paciente() {
    console.log("el id que traigo: ", $("#idexpediente").val());
    let edad_paciente = 0;
    let idexpediente = $("#idexpediente").val();
    var datos = { "consultar_info": "si_coneste_id", "id": idexpediente }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Consultas_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar especifico", json);
        if (json[0] == "Exito") {

            $("#nombre_paciente_c").empty().html("Paciente - " + json[2]["nombre_paciente"] + " " + json[2]["apellido_paciente"]);

            //NUM EXPE
            $("#num_expediente_c").empty().html("Expediente N°: " + json[2]['id_expediente']);

            //DATOS DEL PACIENTE 
            edad_paciente = edad(json[2]['fecha_paciente']);
            $("#edad_paciente_c").empty().html("Edad: " + edad_paciente);
            $("#sexo_paciente_c").empty().html("Sexo: " + json[2]['sexo_paciente']);

            //datos previos a la consulta
            $("#idexpe_preparado").val(json[2]['id_expe_preparado']);
            $("#presion_a_c").val(json[2]['presion_consulta']);
            $("#peso_c").val(json[2]['peso_consulta']);
            $("#altura_ac").val(json[2]['altura_consulta']);
            $("#temperatura_c").val(json[2]['temp_consulta']);

        }
    }).fail(function () {

    }).always(function () {

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