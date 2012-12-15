$(function(){

	//1.Altura de la división de navegación
	var altura = $("#content").css("height");
	//console.log(altura);
	//console.log($("#footer").offset().top);
	$("#navigation").css("height",altura);


	//2.Añadir y/o editar contenido
	$("#js-codigo,#php-codigo").click(function(e){
		e.preventDefault();
		var elem = $(this);
		var lenguaje = elem.attr("data-codigo");
		var html = '<pre class="brush: '+ lenguaje +';">codigo html</pre>';
		console.log(html);
		
		$("#resultado-codigo").text(html).show("slow");
	});

	//3.Añadir imagenes añadidas.
	$("#enlace-imagenes").click(function(e){

		var ruta = "librerias/imagenes-ajax.php";
		$.ajax({
			url: ruta,
			success: recibirContenido
		});

		function recibirContenido(data){
			$("#slider-imagenes").html(data).show("slow");
			$("#enlace-imagenes").hide();
			//Mostrar un boton de ocultar -->Por implementar...

			$(".imagen-por-ajax").click(function(e){
				var elem = $(this);
				var ruta = elem.attr("data-ruta");
				var enlace = '<a href="archivos/'+ruta+'" class="fancybox"><img style="width:300px" src="archivos/'+ ruta +'" alt="' + ruta + '" /></a>';
				console.log(enlace);
				$("#resultado-imagen").text(enlace).show("slow");
			});
		}
	});

});