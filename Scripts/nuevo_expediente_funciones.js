
document.getElementById("otro_metodo_planificacion").readOnly = true;
document.getElementById("encargado_paciente").readOnly = true;
document.getElementById("select_rubro_empresa").disabled = true;
document.getElementById("select_factores_riesgo_laboral").disabled = true;

let sexo_paciente = "";
let edad_paciente = "";
$(function () {

    nombre_paciente();

    elementos_bloqueados();

    apagar_campos_mtpf();

    editar();

    $('#fr_registro_expedientes').validate({
        rules: {
            menarca_g: {
                required: true
            },
            numero_embarazos: {
                required: true
            },
            num_partos: {
                required: true
            },
            num_hijos: {
                required: true
            },
            fecha_ult_menstruacion: {
                required: true
            },
            fecha_ult_parto: {
                required: true
            },
            innicio_sexualidad: {
                required: true
            },
            num_parejas: {
                required: true
            },
            num_parejas_hetero: {
                required: true
            },
            num_parejas_homo: {
                required: true
            },
            num_parejas_bi: {
                required: true
            },
            padecimiento_actual: {
                required: true
            },
            aparatos_sistemas: {
                required: true
            },
            auxiliares_diagnostico_previo: {
                required: true
            },
        },

        messages: {
            menarca_g: {
                required: "Por favor completa este campo"
            },
            numero_embarazos: {
                required: "Por favor completa este campo"
            },
            num_partos: {
                required: "Por favor completa este campo"
            },
            num_hijos: {
                required: "Por favor completa este campo"
            },
            fecha_ult_menstruacion: {
                required: "Por favor completa este campo"
            },
            fecha_ult_parto: {
                required: "Por favor completa este campo"
            },
            innicio_sexualidad: {
                required: "Por favor completa este campo"
            },
            num_hijos: {
                required: "Por favor completa este campo"
            },
            num_parejas: {
                required: "Por favor completa este campo"
            },
            num_parejas_hetero: {
                required: "Por favor completa este campo"
            },
            num_parejas_homo: {
                required: "Por favor completa este campo"
            },
            num_parejas_bi: {
                required: "Por favor completa este campo"
            },
            padecimiento_actual: {
                required: "Por favor completa este campo"
            },
            aparatos_sistemas: {
                required: "Por favor completa este campo"
            },
            auxiliares_diagnostico_previo: {
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



    $(document).on("change", "#select_ocupacion", function (e) {
        e.preventDefault();

        if ($("#select_ocupacion").val() === "Empleado" || $("#select_ocupacion").val() === "Negocio Propio") {

            document.getElementById("select_rubro_empresa").disabled = false;
            document.getElementById("select_factores_riesgo_laboral").disabled = false;
            document.getElementById("select_tiempo_ocupacion").disabled = false;

        } else if (($("#select_ocupacion").val() === "Ninguna")) {

            document.getElementById("select_rubro_empresa").disabled = true;
            document.getElementById("select_factores_riesgo_laboral").disabled = true;
            document.getElementById("select_tiempo_ocupacion").disabled = true;

        } else {

            document.getElementById("select_rubro_empresa").disabled = true;
            document.getElementById("select_factores_riesgo_laboral").disabled = true;

        }

    });

    $(document).on("click", "#numero_embarazos", function (e) {
        e.preventDefault();

        if ($("#numero_embarazos").val() == 0) {
            console.log("si llegó aquí");
            document.getElementById("fecha_ult_parto").readOnly = true;
            document.getElementById("num_hijos").readOnly = true;
            document.querySelector('input[name="rbtn_bajo_peso_nacer"]:disabled');
            document.getElementById("num_macros").readOnly = true;
            document.getElementById("num_partos").readOnly = true;
        } else {

            document.getElementById("fecha_ult_parto").readOnly = false;
            document.getElementById("num_hijos").readOnly = false;
            document.querySelector('input[name="rbtn_bajo_peso_nacer"]:enabled');
            document.getElementById("num_macros").readOnly = false;
            document.getElementById("num_partos").readOnly = false;
        }

    });

    //Métodos que verifican si ya hicio la vida sexual

    document.getElementById("rbtn_vs_si").onclick = function () {
        if (document.getElementById("rbtn_vs_si").checked) {

            document.getElementById("innicio_sexualidad").disabled = false;
            document.getElementById("num_hijos").disabled = false;
            document.getElementById("num_parejas").disabled = false;
            document.getElementById("num_parejas_hetero").disabled = false;
            document.getElementById("num_parejas_homo").disabled = false;
            document.getElementById("num_parejas_bi").disabled = false;
        }
    }
    document.getElementById("rbtn_vs_no").onclick = function () {
        if (document.getElementById("rbtn_vs_no").checked) {

            document.getElementById("innicio_sexualidad").disabled = true;
            document.getElementById("num_hijos").disabled = true;
            document.getElementById("num_parejas").disabled = true;
            document.getElementById("num_parejas_hetero").disabled = true;
            document.getElementById("num_parejas_homo").disabled = true;
            document.getElementById("num_parejas_bi").disabled = true;
        }
    }

    $(document).on("change", "#select_personales_patologicos", function (e) {
        e.preventDefault();

        if ($("#select_personales_patologicos").val() === "OTRO") {

            document.getElementById("otra_patologia").disabled = false;
        } else {

            document.getElementById("otra_patologia").disabled = true;
        }

    });

    //filtro para registrar el paciente
    $(document).on("submit", "#fr_registro_expedientes", function (e) {
        e.preventDefault();
        let datos = $("#fr_registro_expedientes").serialize();

        /* hereditarios y familiares */
        if (!document.querySelector('input[name="rbtn_diabetes_mellitus"]:checked')) {
            toastr.info("¿Diabetes Mellitus?", "Hereditarios y Familiares", {
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
        } else if ($("#select_parentesco_diabetes").val() == "Seleccione" && document.getElementById("rbtn_diabetes_melli_si").checked) {

            toastr.info("¿Parentesco de la Diabetes?", "Hereditarios y Familiares", {
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

            if (!document.querySelector('input[name="rbtn_hipertension_arterial"]:checked')) {

                toastr.info("¿Hipertensión Arterial?", "Expediente", {
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

            } else if ($("#select_parentesco_hipertension").val() == "Seleccione" && document.getElementById("rbtn_hiper_arte_si").checked) {

                toastr.info("¿Parentesco de la Hipertensión?", "Expediente", {
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

                if (!document.querySelector('input[name="rbtn_cardiopatia"]:checked')) {

                    toastr.info("¿Cardipatía Hisquémica?", "Expediente", {
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

                } else if ($("#select_parentesco_cardiopatia").val() == "Seleccione" && document.getElementById("rbtn_cardiopatia_si").checked) {

                    toastr.info("¿Parentesco de la Cardipatía?", "Expediente", {
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

                    if (!document.querySelector('input[name="rbtn_cancer"]:checked')) {
                        toastr.info("¿Cancer?", "Expediente", {
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

                    } else if ($("#select_parentesco_cancer").val() == "Seleccione" && document.getElementById("rbtn_cancer_si").checked) {

                        toastr.info("¿Parentesco del Cancer?", "Expediente", {
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

                        /* tipo de familia */
                        if (!document.querySelector('input[name="rbtn_tipo_familia"]:checked')) {

                            toastr.info("¿Tipo de Familia?", "Expediente", {
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


                            if (!document.querySelector('input[name="rbtn_rol_madre"]:checked')) {

                                toastr.info("¿Rol de la Madre?", "Expediente", {
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

                                if (!document.querySelector('input[name="rbtn_familia"]:checked')) {

                                    toastr.info("¿Familia?", "Expediente", {
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

                                    if (!document.querySelector('input[name="rbtn_disfunciones_familiares"]:checked')) {

                                        toastr.info("¿Disfunciones familiares?", "Expediente", {
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
                                        /* personales no patológicos */
                                        if ($("#select_estado_civil").val() == "Seleccione") {

                                            toastr.info("¿Estado civil?", "Expediente - No Patológicos", {
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

                                            if ($("#select_escolaridad").val() == "Seleccione") {

                                                toastr.info("¿Tipo de escolaridad?", "Expediente - No Patológicos", {
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

                                                if ($("#select_religion").val() == "Seleccione") {

                                                    toastr.info("¿Tipo de religión?", "Expediente - No Patológicos", {
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

                                                    if ($("#select_alimentacion").val() == "Seleccione") {

                                                        toastr.info("¿Tipo de alimentación?", "Expediente - No Patológicos", {
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

                                                        if ($("#select_habitacion").val() == "Seleccione") {

                                                            toastr.info("¿Tipo habitación?", "Expediente - No Patológicos", {
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

                                                            if ($("#select_higiene").val() == "Seleccione") {

                                                                toastr.info("¿Tipo higiene?", "Expediente - No Patológicos", {
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

                                                                if ($("#select_ocupacion").val() == "Seleccione") {

                                                                    toastr.info("¿Tipo de ocupación?", "Expediente - No Patológicos", {
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

                                                                    if ($("#select_tiempo_ocupacion").val() == "Seleccione" &&
                                                                        document.getElementById("select_tiempo_ocupacion").disabled == false) {

                                                                        toastr.info("¿Tiempo en ocupación?", "Expediente - No Patológicos", {
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

                                                                        if ($("#select_rubro_empresa").val() == "Seleccione" &&
                                                                            document.getElementById("select_rubro_empresa").disabled == false) {

                                                                            toastr.info("¿Rubro de la empresa?", "Expediente - No Patológicos", {
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

                                                                            if ($("#select_factores_riesgo_laboral").val() == "Seleccione" &&
                                                                                document.getElementById("select_factores_riesgo_laboral").disabled == false) {

                                                                                toastr.info("¿Riesgo Laboral?", "Expediente - No Patológicos", {
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

                                                                                if ($("#select_actividad_fisica").val() == "Seleccione") {

                                                                                    toastr.info("¿actividad física?", "Expediente - No Patológicos", {
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

                                                                                    if ($("#select_tipo_actividad_fisica").val() == "Seleccione") {

                                                                                        toastr.info("¿Tipo de actividad física?", "Expediente - No Patológicos", {
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

                                                                                        /* personales patológicos */
                                                                                        if ($("#select_personales_patologicos").val() == "Seleccione") {

                                                                                            toastr.info("¿Patología?", "Expediente - Patológicos", {
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

                                                                                            if (document.getElementById("otra_patologia").disabled == false && $("#otra_patologia").val() == "") {

                                                                                                toastr.info("Especifique el tipo de Patología", "Expediente - Patológicos", {
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
                                                                                                /* GINECOBSTETRICOS */
                                                                                                if (sexo_paciente == "Masculino") {

                                                                                                    $('#fr_registro_expedientes').validate({
                                                                                                        rules: {
                                                                                                            innicio_sexualidad: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            num_hijos: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            num_parejas: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            num_parejas_hetero: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            num_parejas_homo: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            num_parejas_bi: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            padecimiento_actual: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            aparatos_sistemas: {
                                                                                                                required: true
                                                                                                            },
                                                                                                            auxiliares_diagnostico_previo: {
                                                                                                                required: true
                                                                                                            },
                                                                                                        },

                                                                                                        messages: {
                                                                                                            innicio_sexualidad: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            num_hijos: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            num_parejas: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            num_parejas_hetero: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            num_parejas_homo: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            num_parejas_bi: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            padecimiento_actual: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            aparatos_sistemas: {
                                                                                                                required: "Por favor completa este campo"
                                                                                                            },
                                                                                                            auxiliares_diagnostico_previo: {
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
                                                                                                    envio_del_formulario(datos);

                                                                                                } else if (sexo_paciente == "Femenino") {

                                                                                                    

                                                                                                    envio_del_formulario(datos);
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    });


});

function verificar_vs_s() {
    document.getElementById("innicio_sexualidad").disabled = false;
    document.getElementById("num_hijos").disabled = false;
    document.getElementById("num_parejas").disabled = false;
    document.getElementById("num_parejas_hetero").disabled = false;
    document.getElementById("num_parejas_homo").disabled = false;
    document.getElementById("num_parejas_bi").disabled = false;
}

function verificar_vs_n() {
    document.getElementById("innicio_sexualidad").disabled = true;
    document.getElementById("num_hijos").disabled = true;
    document.getElementById("num_parejas").disabled = true;
    document.getElementById("num_parejas_hetero").disabled = true;
    document.getElementById("num_parejas_homo").disabled = true;
    document.getElementById("num_parejas_bi").disabled = true;
}

function verificar_ocupacion() {
    if ($("#select_ocupacion").val() === "Empleado" || $("#select_ocupacion").val() === "Negocio Propio") {

        document.getElementById("select_rubro_empresa").disabled = false;
        document.getElementById("select_factores_riesgo_laboral").disabled = false;
        document.getElementById("select_tiempo_ocupacion").disabled = false;

    } else if (($("#select_ocupacion").val() === "Ninguna")) {

       
        document.getElementById("select_rubro_empresa").disabled = true;
        document.getElementById("select_factores_riesgo_laboral").disabled = true;
        document.getElementById("select_tiempo_ocupacion").disabled = true;

    } else {

        document.getElementById("select_rubro_empresa").disabled = true;
        document.getElementById("select_factores_riesgo_laboral").disabled = true;

    }
}


function apagar_campos_mtpf() {

    document.getElementById("rbtn_mp_otro").onclick = function () {
        if (document.getElementById("rbtn_mp_otro").checked) {

            document.getElementById("otro_metodo_planificacion").readOnly = false;
        } else {
            document.getElementById("otro_metodo_planificacion").readOnly = true;
        }
    }

    document.getElementById("rbtn_mp_diu").onclick = function () {
        if (document.getElementById("rbtn_mp_diu").checked) {

            document.getElementById("otro_metodo_planificacion").readOnly = true;
        }
    }

    document.getElementById("rbtn_mp_hormonal").onclick = function () {
        if (document.getElementById("rbtn_mp_hormonal").checked) {

            document.getElementById("otro_metodo_planificacion").readOnly = true;
        }
    }

    document.getElementById("rbtn_mp_quirurgico").onclick = function () {
        if (document.getElementById("rbtn_mp_quirurgico").checked) {

            document.getElementById("otro_metodo_planificacion").readOnly = true;
        }
    }
    document.getElementById("rbtn_mp_ninguno").onclick = function () {
        if (document.getElementById("rbtn_mp_ninguno").checked) {

            document.getElementById("otro_metodo_planificacion").readOnly = true;
        }
    }
}

//solicitud al servidor para la inserción de los datos
function envio_del_formulario(datos) {
    console.log("Imprimiendo datos: ", datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Expediente_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL GUARDAR", json);

        if (json[0] == "Exito") {
            let texto_succes = "";

            if ($("#existente").val() == "0") {
                texto_succes = 'Guardado con éxtio!';
            } else {
                texto_succes = 'Modificado con éxtio!';
            }

            Swal.fire({
                icon: 'success',
                title: 'Expediente',
                text: texto_succes,
                confirmButtonText: "Ok",
            }).then((confirmacion) => {
                if (confirmacion) {
                    $("#fr_registro_expedientes").trigger('reset');
                    $(location).attr('href', 'index.php');
                } else
                    ;
            });



        } else if (json[0] == "Error") {
            Swal.fire({
                icon: 'error',
                title: 'Expediente',
                text: 'Algo salió mal !'
            });
        }
    });
}

function nombre_paciente() {
    console.log("el id que traigo: ", $("#id_paciente").val());

    let id_paciente = $("#id_paciente").val();
    var datos = { "mostrar_paciente": "si_coneste_id", "id": id_paciente }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../Controladores/Expediente_Controlador.php',
        data: datos,
    }).done(function (json) {
        console.log("EL consultar especifico", json);
        if (json[0] == "Exito") {
            if ($("#existente").val() == "1") {
                $("#nombre_paciente").empty().html("Editar Expediente - " + json[2]["paciente"]);
            } else {
                $("#nombre_paciente").empty().html("Nuevo Expediente - " + json[2]["paciente"]);
            }

            let edad = obtener_edad(json[2]["fecha_paciente"])
            sexo_paciente = json[2]["sexo_paciente"];
            elementos_bloqueados(json[2]["sexo_paciente"], edad);
            if (json[2]["nombres_encargado"] != null) {

                $("#encargado_paciente").val(json[2]["nombres_encargado"]);

            } else {
                $("#encargado_paciente").val("Sin encargado");

            }
            console.log("encargado: ", $("#encargado_paciente").val());
        }
    }).fail(function () {

    }).always(function () {

    });
}

function elementos_bloqueados(sexo_paciente, edad) {


    console.log("Sexo del paciente: ", sexo_paciente);

    if (sexo_paciente === "Masculino" && edad >= 18) {

        vaciar_elementos_desactivados();

        document.getElementById("menarca_g").disabled = true;

        document.getElementById("numero_embarazos").disabled = true;

        document.getElementById("num_partos").disabled = true;

        document.getElementById("fecha_ult_menstruacion").disabled = true;

        document.getElementById("fecha_ult_parto").disabled = true;

        document.getElementById("num_macros").disabled = true;

        document.querySelector('input[name="rbtn_bajo_peso_nacer"]:disabled');

        document.getElementById("rbtn_bpn_si").disabled = true;

        document.getElementById("rbtn_bpn_no").disabled = true;

        document.getElementById("rbtn_mp_diu").disabled = true;

        document.getElementById("rbtn_mp_hormonal").disabled = true;

        document.getElementById("rbtn_mp_quirurgico").disabled = true;

        document.getElementById("rbtn_mp_otro").disabled = true;

        document.getElementById("rbtn_mp_ninguno").disabled = true;

    } else if (sexo_paciente === "Masculino" && edad < 18) {

        vaciar_elementos_desactivados();

        document.getElementById("menarca_g").disabled = true;

        document.getElementById("numero_embarazos").disabled = true;

        document.getElementById("num_partos").disabled = true;

        document.getElementById("fecha_ult_menstruacion").disabled = true;

        document.getElementById("fecha_ult_parto").disabled = true;

        document.getElementById("num_macros").disabled = true;

        document.getElementById("rbtn_bpn_si").disabled = true;

        document.getElementById("rbtn_bpn_no").disabled = true;

        document.getElementById("rbtn_mp_diu").disabled = true;

        document.getElementById("rbtn_mp_hormonal").disabled = true;

        document.getElementById("rbtn_mp_quirurgico").disabled = true;

        document.getElementById("rbtn_mp_otro").disabled = true;

        document.getElementById("rbtn_mp_ninguno").disabled = true;

        document.getElementById("otro_metodo_planificacion").disabled = true;
    }

}
function vaciar_elementos_desactivados() {

    $("#numero_embarazos").val(0);
    $("#fecha_ult_menstruacion").val("");
    $("#fecha_ult_parto").val("");
}

function obtener_edad(fecha) {
    let edad = 0;

    ahora = new Date();
    año_actual = ahora.getFullYear();

    //divido la fecha para obtener el año
    separacion = fecha.split("-");
    año = separacion[0];
    edad = parseInt(año_actual) - parseInt(año);
    edad_paciente = edad;
    return edad;
}

//ESTA FUNCION ES PARA QUE EDITES
function editar() {

    let idexpe = $("#id_expediente").val();
    let idpa = $("#id_paciente").val();
    console.log("e: " + idexpe + ", p: " + idpa);
    var datos = { "editar_expediente": "si_coneste_id", "id_expe": idexpe, 'idpaciente': idpa }
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
            $("#num_expediente").empty().html("N°: " + json[2]['id_expediente']);

            //DATOS DEL PACIENTE 
            edad_paciente = edad(json[3]['fecha_paciente']);
            $("#edad_paciente_e").empty().html("Edad: " + edad_paciente);
            $("#sexo_paciente_e").empty().html("Sexo: " + json[3]['sexo_paciente']);

            if (json[4] === null) {
                $("#responsable_v").empty().html("Sin Encargado");
            } else {
                $("#responsable_v").empty().html(json[4]);
            }


            //HEREDITARIOS Y FAMILIARES

            if (json[2]['diabetes_mellitus'] == "NO") {
                document.getElementById("rbtn_diabetes_melli_no").checked = true;
            } else if (json[2]['diabetes_mellitus'] == "SI") {
                document.getElementById("rbtn_diabetes_melli_si").checked = true;
            } else {

            }

            if (json[2]['parentesco_diabetes'] == 'n/a') {

            } else {
                $("#select_parentesco_diabetes").val(json[2]['parentesco_diabetes']);
            }


            if (json[2]['hipertension_arterial'] == "NO") {
                document.getElementById("rbtn_hiper_arte_no").checked = true;
            } else if (json[2]['hipertension_arterial'] == "SI") {
                document.getElementById("rbtn_hiper_arte_si").checked = true;
            } else {

            }


            if (json[2]['parentesco_hip_ar'] == 'n/a') {

            } else {
                $("#select_parentesco_hipertension").val(json[2]['parentesco_hip_ar']);
            }

            if (json[2]['cardipatia_isquemica'] == "NO") {
                document.getElementById("rbtn_cardiopatia_no").checked = true;
            } else if (json[2]['cardipatia_isquemica'] == "SI") {
                document.getElementById("rbtn_cardiopatia_si").checked = true;
            } else {

            }

            if (json[2]['parentesco_card_isq'] == 'n/a') {

            } else {
                $("#select_parentesco_cardiopatia").val(json[2]['parentesco_card_isq']);
            }

            $("#cancer_v").empty().html(json[2]['cancer']);
            if (json[2]['parentesco_can'] == 'n/a') {
                $("#p_cancer_v").empty().html('...');
            } else {
                $("#p_cancer_v").empty().html(json[2]['parentesco_can']);
            }

            if (json[2]['cancer'] == "NO") {
                document.getElementById("rbtn_cancer_no").checked = true;
            } else if (json[2]['cancer'] == "SI") {
                document.getElementById("rbtn_cancer_si").checked = true;
            } else {

            }

            if (json[2]['parentesco_can'] == 'n/a') {

            } else {
                $("#select_parentesco_cancer").val(json[2]['parentesco_can']);
            }

            if (json[2]['otro_hereditario'] == 'n/a') {

            } else {
                $("#otros_hereitarios").val(json[2]['otro_hereditario']);
            }

            //TIPO FAMILIA
            if (json[2]['tipo_familia'] == "NUCLEAR") {
                document.getElementById("rbtn_tf_nuclear").checked = true;
            } else if (json[2]['tipo_familia'] == "EXTENSA") {
                document.getElementById("rbtn_tf_extensa").checked = true;
            } else if (json[2]['tipo_familia'] == "COMPUESTA") {
                document.getElementById("rbtn_tf_compuesta").checked = true;
            } else {

            }

            if (json[2]['rol_madre'] == "E-M") {
                document.getElementById("rbtn_rm_em").checked = true;
            } else if (json[2]['rol_madre'] == "E-C") {
                document.getElementById("rbtn_rm_ec").checked = true;
            } else if (json[2]['rol_madre'] == "E-S") {
                document.getElementById("rbtn_rm_es").checked = true;
            } else {

            }

            if (json[2]['familia'] == "I") {
                document.getElementById("rbtn_f_i").checked = true;
            } else if (json[2]['familia'] == "D") {
                document.getElementById("rbtn_f_d").checked = true;
            } else {

            }

            if (json[2]['disfunciones_familiares'] == "SI") {
                document.getElementById("rbtn_df_si").checked = true;
            } else if (json[2]['disfunciones_familiares'] == "NO") {
                document.getElementById("rbtn_df_no").checked = true;
            } else {

            }

            //PERSONALES NO PATOLÓGICOS
            $("#select_estado_civil").val(json[2]['esado_civil']);
            $("#select_religion").val(json[2]['religion']);
            $("#select_habitacion").val(json[2]['habitacion']);
            $("#select_ocupacion").val(json[2]['ocupacion']);

            if ($("#select_ocupacion").val() != "Empleado" && $("#select_ocupacion").val() != "Negocio Propio") {

            } else if ($("#select_ocupacion").val() == "Ninguna") {
               
                document.getElementById("select_rubro_empresa").disabled = true;
                document.getElementById("select_tiempo_ocupacion").disabled = true;
                document.getElementById("select_factores_riesgo_laboral").disabled = true;

            } else {
                $("#select_rubro_empresa").val("Seleccione");
                $("#select_factores_riesgo_laboral").val("Seleccione");
                document.getElementById("select_rubro_empresa").disabled = true;
                document.getElementById("select_factores_riesgo_laboral").disabled = true;

            }

            verificar_ocupacion();

            if (json[2]['actividad_empresa'] != 'n/a') {
                $("#select_rubro_empresa").val(json[2]['actividad_empresa']);
            } else {
            }
            $("#select_actividad_fisica").val(json[2]['actividad_fisica']);
            $("#select_escolaridad").val(json[2]['escolaridad']);
            $("#select_alimentacion").val(json[2]['alimentacion']);
            $("#select_higiene").val(json[2]['higiene_personal']);

            if (json[2]['tiempo_ocupacion'] != 'n/a') {
                $("#select_tiempo_ocupacion").val(json[2]['tiempo_ocupacion']);
            } else {
            }

            if (json[2]['factores_riesgo_laboral'] != 'n/a') {
                $("#select_factores_riesgo_laboral").val(json[2]['factores_riesgo_laboral']);
            } else {

            }

            //PERSONALES PATOLÓGICOS
            if (json[2]['patologias'] != 'MÉDICO' && json[2]['patologias'] != 'QUIRÚRGICO' && json[2]['patologias'] != 'TRANSFUNCIONALES TABAQUISMO'
                && json[2]['patologias'] != 'ALCOHOLISMOS' && json[2]['patologias'] != 'ALÉRGICOS' && json[2]['patologias'] != 'DEPENDENCIA A DROGAS O MEDICAMENTOS'
                && json[2]['patologias'] != 'NINIGUNA' && json[2]['patologias'] != 'OTRO') {
                document.getElementById("otra_patologia").disabled = false;
                $("#otra_patologia").empty().html(json[2]['patologias']);
            } else {
                document.getElementById("otra_patologia").disabled = true;
                $("#select_personales_patologicos").val(json[2]['patologias']);

            }

            //GINECOBSTETRICOS
            $("#menarca_g").val(json[2]['menarca']);
            if (json[2]['inicio_vida_sexual'] == '0') {
                document.getElementById("rbtn_vs_no").checked = true;
                verificar_vs_n();
            } else {

                document.getElementById("rbtn_vs_si").checked = true;
                verificar_vs_s();
            }

            $("#innicio_sexualidad").val(json[2]['inicio_vida_sexual']);

            if (json[2]['fecha_ultima_menstruacion'] == '0000-00-00') {

            } else {
                $("#fecha_ult_menstruacion").val(json[2]['fecha_ultima_menstruacion']);
            }

            $("#num_hijos").val(json[2]['num_hijos']);
            $("#num_macros").val(json[2]['macrosomicos_vivos']);

            if (json[2]['bajo_peso_nacer'] == 'n/a') {

            } else if (json[2]['bajo_peso_nacer'] == "SI") {
                document.getElementById("rbtn_bpn_si").checked = true;

            } else if (json[2]['bajo_peso_nacer'] == "NO") {
                document.getElementById("rbtn_bpn_si").checked = true;
            } else {

            }

            $("#num_parejas").val(json[2]['num_parejas']);
            $("#num_parejas_homo").val(json[2]['num_homosexuales']);
            $("#numero_embarazos").val(json[2]['num_embarazos']);
            $("#num_partos").val(json[2]['num_partos']);
            if (json[2]['fecha_ultimo_parto'] == '0000-00-00') {

            } else {
                $("#fecha_ult_parto").val(json[2]['fecha_ultimo_parto']);
            }
            $("#num_parejas_hetero").val(json[2]['num_heteros']);
            $("#num_parejas_bi").val(json[2]['num_bisexuales']);

            if (json[2]['metodo_planificacion_familiar'] == 'n/a') {

            } else if (json[2]['metodo_planificacion_familiar'] == "DIU") {
                document.getElementById("rbtn_mp_diu").checked = true;

            } else if (json[2]['metodo_planificacion_familiar'] == "Hormonal") {
                document.getElementById("rbtn_mp_hormonal").checked = true;

            }else if (json[2]['metodo_planificacion_familiar'] == "Quirúrgico") {
                document.getElementById("rbtn_mp_quirurgico").checked = true;

            }else if (json[2]['metodo_planificacion_familiar'] == "Otro") {
                document.getElementById("rbtn_mp_otro").checked = true;
                $("#otro_metodo_planificacion").val(json[2]['metodo_planificacion_familiar']);
            }else if (json[2]['metodo_planificacion_familiar'] == "Ninguno") {
                document.getElementById("rbtn_mp_ninguno").checked = true;

            } else {

            }

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