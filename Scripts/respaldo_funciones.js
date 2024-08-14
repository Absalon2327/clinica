//cargar los datos de la tabla
cargartabla();

//activamos el boton del menu lateral 
document.getElementById('menu_respaldos').classList.add('active');

function crearcopia() {
    Swal.fire({
        title: 'Desea crear una copia de la base de datos?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Crear copia',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                dataType: "json",
                method: "POST",
                url: './backup.php',
            }).done(function (json) {
                if (json[0] == "Exito") {
                    cargartabla();
                    Swal.fire({
                        icon: 'success',
                        title: 'Respaldo',
                        text: 'El respaldo se ha creado con exito!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (json[0] == "Error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Respaldo',
                        text: 'Ha ocurrido un error!',
                        showConfirmButton: false,
                        timer: 1700
                    })
                }
            });

        }
    })
}


//----- Funcion para Restaurar copia de base -------//
$(document).on("click", ".btn_restaurar", function (e) {
    e.preventDefault();
    var base = $(this).attr("data-base");

    Swal.fire({
        title: 'Desea restaurar esta copia de base de datos?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Restaurar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = { action: "restaurar", database: base };
            $.ajax({
                dataType: "json",
                method: "POST",
                url: './restore.php',
                data: datos,
            }).done(function (json) {
                if (json[0] == "Exito") {
                    cargartabla();
                    Swal.fire({
                        icon: 'success',
                        title: 'Restauracion',
                        text: 'Se ha restaurado con exito!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (json[0] == "Error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Restauracion',
                        text: 'Ha ocurrido un error!',
                        showConfirmButton: false,
                        timer: 1700
                    })
                }
            });
        }
    })
});
//----- Funcion para Restaurar copia de base -------//


//----- Funcion para eliminar copia de base -------//
$(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();
    var base = $(this).attr("data-base");

    Swal.fire({
        title: 'Desea eliminar esta copia de base de datos?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Calcelar',
        denyButtonText: `Eliminar`,
    }).then((result) => {
        if (result.isDenied) {
            var datos = { action: "eliminar", database: base };
            $.ajax({
                dataType: "json",
                method: "POST",
                url: './restore.php',
                data: datos,
            }).done(function (json) {
                if (json[0] == "Exito") {
                    cargartabla();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminacion',
                        text: 'Se ha elininado con exito!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (json[0] == "Error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Eliminacion',
                        text: 'Ha ocurrido un error!',
                        showConfirmButton: false,
                        timer: 1700
                    })
                }
            });
        }
    })
});
//----- Funcion para eliminar copia de base -------//

//--------------- Cargar tabla --------------------//

function cargartabla() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("tablaRespaldo").innerHTML = xmlhttp.responseText;
            $("#tabla_respaldo").DataTable();
        }
    };

    xmlhttp.open("GET", "./../../Vistas/tablas/tabla_respaldo.php", true);
    xmlhttp.send();
}
//--------------- Cargar tabla --------------------//