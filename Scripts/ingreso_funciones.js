

$(function(){
	console.log("todo esta integrado");

	$('#actualizar_pass').validate({
		rules: {
			contrasena: {
				required: true,
				minlength: 6  
	
			},
			recontrasena: {
				required: true,
				minlength: 6  
			},
			
		},
		messages: {
			contrasena: {
				required: "Por favor completa este campo",
				minlength: "Digite 6 caracteres como mínimo"
			},
			recontrasena: {
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

	$(document).on("submit","#formulario_login",function(event){
		event.preventDefault();
		var datos = $("#formulario_login").serialize();
		console.log("evento submit",datos); 
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'controladores/controlador_Ingreso.php',
	        data : datos,
	    }).done(function(json) {
	    	 console.log("el login: ",json);
	    	 if (json[0]=="Exito") {
				console.log("sesiones: ",json[3]);
				Swal.fire({
				  icon: 'success',
				  title: json[1]
				});
				var timer = setInterval(function(){
					$(location).attr('href','Vistas/principal/index.php');
					clearTimeout(timer);
				},3500)
	    	 }else if (json[0]=="Error"){
	    	 	Swal.fire({
				  icon: 'error',
				  title: json[1]
				});
	    	 }

	    });


	});

	$(document).on("submit","#formulario_desbloqueo1",function(event){
		event.preventDefault();
		var datos = $("#formulario_desbloqueo1").serialize();
		console.log("formulario desbloqueo",datos);
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../../controladores/controlador_Ingreso.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log(" desbloqueo",json);
	    	if (json[0]=="Exito") {
	    	 	
				Swal.fire({
				  icon: 'success',
				  title: json[1]
				});
				var timer = setInterval(function(){
					$(location).attr('href','../principal/index.php');
					clearTimeout(timer); 
				},3500)
	    	 }else{
	    	 	Swal.fire({
				  icon: 'error',
				  title: json[1]
				});
	    	 }

	    });
	});

	$(document).on("submit","#validar_dui",function(event){
		event.preventDefault();

		var datos = $("#validar_dui").serialize();
		console.log("datos enviados: ",datos);
		$.ajax({
		   dataType: "json",
		   method: "POST",
		   url:'../../controladores/controlador_Ingreso.php',
		   data : datos,
	   }).done(function(json) {
		   console.log("Dui VALIDADO",json);
		   if (json[0]=="Exito") {
			   $("#id_persona").val(json[2]);
			   $("#validar_dui").removeClass("mostrar").addClass("hiden");
			   $("#actualizar_pass").removeClass("hiden").addClass("mostrar");

		   }else{
			   Swal.fire({
				 icon: 'error',
				 title: "El DUI ingresado no existe"
			   });
		   }

	   }).always(function(){
		   Swal.close();
	   });


	});

	$(document).on("submit","#actualizar_pass",function(event){
		event.preventDefault();
		if ($("#contrasena").val() != $("#recontrasena").val()) {

 			Swal.fire({
			  icon: 'error',
			  title: "Oops",
			  html:'Las contraseñas no coinciden'
			});
			return;
 		}
		
		var datos = $("#actualizar_pass").serialize();
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../../controladores/controlador_Ingreso.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("actualizar pass",json);
	    	if (json[0]=="Exito") {
	    		
	    		Swal.fire({
				  icon: 'success',
				  title: "Su contraseña se ha actualizado",
				  html:"Espere mientras se redirige al login"
				});

				var timer = setInterval(function(){
					$(location).attr('href','../../index.php');
					clearTimeout(timer); 
				},3500)
	    	}
	    }).always(function(){
	    	
	    })

	});

});

function validacionDui() {
	$dui2 = document.getElementById("dui").value;

	if ($dui2.length == 8 || ($dui2.length == 9 && $dui2.charAt($dui2.length - 1) != "-")) {
		if ($dui2.length == 9 && $dui2.charAt($dui2.length - 1) != "-") {
			$dui2 = $dui2.slice(0, $dui2.length - 1) + "-" + $dui2.slice($dui2.length - 1);
			$("#dui").val($dui2);
		} else {
			$dui2 = $dui2 + "-";
			$("#dui").val($dui2);
		}
	} else if ($dui2.length == 9) {
		document.getElementById("dui").value = $dui2.substring(0, $dui2.length - 1);
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