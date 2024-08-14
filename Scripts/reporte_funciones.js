//cargar los datos de la tabla
cargartabla();

//activamos el boton del menu lateral 
document.getElementById('menu_reportes').classList.add('active');


//----- Funcion para ver PDF -------//
$(document).on("click", ".btn_ver", function (e) {
    e.preventDefault();
    var objet = document.getElementById("pdf");
    var base = $(this).attr("data-base");
    cargarPDF(base);
});
//----- Funcion para ver PDF -------//


//----- Funcion para eliminar documento -------//
$(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();
    var base = $(this).attr("data-base");

    Swal.fire({
        title: 'Desea eliminar este reporte?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Cancelar',
        denyButtonText: `Eliminar`,
    }).then((result) => {
        if (result.isDenied) {
            var datos = { action: "eliminar", database: base };
            $.ajax({
                dataType: "json",
                method: "POST",
                url: './acciones.php',
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
//----- Funcion para eliminar documento -------//

/* Funcion para cargar reportes */

function reportes_ready() {
    var repo = document.getElementById('reportes').value;
    var altura = screen.height;
    var ancho = screen.width;

    if (repo == './citas_pendientes.php') {
        setTimeout(function () { cargartabla(); }, 1000);
        window.open(repo, "Citas Pendientes", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Citas Pendientes, width=" + ancho + ", height=" + altura);
    }else if (repo == './pacientes_mayores.php') {
        setTimeout(function () { cargartabla(); }, 1000);
        window.open(repo, "pacientesadultos", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Citas Pendientes, width=" + ancho + ", height=" + altura);
    } else if (repo == './pacientes_menores.php') {
        setTimeout(function () { cargartabla(); }, 1000);
        window.open(repo, "pacientesmenores", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Citas Pendientes, width=" + ancho + ", height=" + altura);
    }else if (repo == './example1.php') {
        setTimeout(function () { cargartabla(); }, 1000);
        window.open(repo, "Ejemplo1", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Citas Pendientes, width=" + ancho + ", height=" + altura);
    } else if (repo == './example2.php') {
        setTimeout(function () { cargartabla(); }, 1000);
        window.open(repo, "Ejemplo2", "directories=no, location=center, menubar=no, scrollbars=yes, statusbar=no, tittlebar=Citas Pendientes, width=" + ancho + ", height=" + altura);
    }
}

/* Funcion para cargar reportes */


//--------------- Cargar tabla --------------------//
function cargartabla() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("tablaDocumentos").innerHTML = xmlhttp.responseText;
            $("#tabla_documentos").DataTable();
        }
    };

    xmlhttp.open("GET", "./../../Vistas/tablas/tabla_documentos.php", true);
    xmlhttp.send();
}
//--------------- Cargar tabla --------------------//


//--------------- Cargar PDF--------------------//
function cargarPDF($ruta) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("objeto").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "./../../Vistas/reportes/acciones.php?ruta=" + $ruta, true);
    xmlhttp.send();
}
//--------------- Cargar PDF--------------------//