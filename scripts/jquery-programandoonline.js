$(function(){
	//1.Mostrar el acordeón de la sección Subcategoria.
	$( "#accordion" ).accordion(
		{ heightStyle: "content" }
	);
	
	
	//2.Para Ampliar el Buscador de Contenido 
	$("#buscador-icon").on("focus",function(e){
		e.preventDefault();
		$("#buscador-icon").animate({
			width : "331px"
		},1000).data("activado",true);
	});

	$("#buscador-icon").on("blur",function(){
		$("#buscador-icon").animate({
			width : "200px"
		},500);
	});

	
	/*3.Script para centrar la imagen y el titulo, y sobre todo para que salga bien la altura de la división de publicidad*/
	var alturaImg = $("#img-jquery").height();

	//console.log("altura: " + alturaImg);
	$(".listado-titulo").css("height",alturaImg + "px");
	

	var centroTexto = (alturaImg/2) - ($(".listado-cabecera").height()/2);;
	$(".listado-cabecera").css({
		"padding-top" : centroTexto + "px",
		"padding-left" : "25px"
	});
	/*Script para centrar la imagen y el titulo, y sobre todo para que salga bien la altura de la división de publicidad*/
	
	//4.Función de Altura de los sidebar.
	function sidebar()
	{
		var Altsidebar = $("#content").height();
		$("#sidebar-left,#busqueda-publicidad").css("height",(Altsidebar + 20) + "px");
		$("#noticia-left").css("height",(Altsidebar+20) + "px");
		
	}
	
	//5.Escribir Comentario.
	
	function reset()
	{
		$("#c-nombre").css("border","1px solid #cccccc").val("");
		$("#c-nombre-text").css({
			color : "#777777"
		})
		.text("Nombre (Obligatorio)").val("");
		
		$("#c-email").css("border","1px solid #cccccc").val("");
		$("#c-email-text").css({
			color : "#777777;"
		})
		.text("E-mail (Obligatorio)");
				
		$("#c-textarea").css("border","1px solid #cccccc").val("");
		$("#c-textarea-text").css({
			color : "#777777;"
		})
		.text("Comentario:");
	}
	
	function insertarComentarioBBDD()
	{
		$("#c-form").on("submit",function(e){
			e.preventDefault();
			
			var nombre = $("#c-nombre");
			var email = $("#c-email");
			var textarea = $("#c-textarea");
			
			if(nombre.val().length == 0 || email.val().length == 0 || textarea.val().length < 5)
			{
				if(nombre.val().length == 0)
				{
					nombre.css("border","1px solid red");
					$("#c-nombre-text").css({
						color : "red"
					})
					.text("El nombre es obligatorio para escribir un comentario.");
				}
				
				if(email.val().length == 0)
				{
					email.css("border","1px solid red");
					$("#c-email-text").css({
						color : "red"
					})
					.text("El e-mail es obligatorio para escribir un comentario (No se publicará en la página). ");
				}
				
				if(textarea.val().length < 5)
				{
					textarea.css("border","1px solid red");
					$("#c-textarea-text").css({
						color : "red"
					})
					.text("El comentario debe tener más de 5 caracteres.");
				}
			}
			else
			{
				var pos = email.val().indexOf("@");
				if(pos<0)
				{
					email.css("border","1px solid red");
					$("#c-email-text").css({
						color : "red"
					})
					.html("Formato de email no valido. Ejemplo: <b>programandoonline@gmail.com</b>");
				}
				else
				{
					//Enviamos el comentario por Ajax
					var ruta = $("#c-form").attr("action");
					//console.log("ruta:",ruta);
					var id = $("#c-form").attr("data-idcontenido");
					$.ajax({
						url: ruta,
						data:{ 
							idcontenido : id,
							nombre: nombre.val(),
							email: email.val(),
							texto: textarea.val()
						},
						success: function(datos){
							if(datos == "ok")
							{
								reset(); //Resetemos el texto de los span y los bordes de las cajas
								mostrarComentarios();
							}
							else
								console.log("Error a el enviar el comentario");
						},
						type: "GET",
						beforeSend: function(){
							var altura = $("#c-form").offset().top + 100;
							var anchura = ($(window).width()-50)/2;
							$("#cargando").css({
								top: altura + "px",
								left: anchura + "px"
							}).show();
						},
						complete: function(){
							$("#cargando").hide(1000);
						},
					});
				}
			}
		});
	}
	
	function mostrarComentarios()
	{
		var id = $("#comentarios-mostrar").attr("data-idcontenido");
		$.ajax({
			url: "librerias/ajax-listar-comentarios.php",
			data:{ idcontenido : id },
			success: function(datos){
				$("#comentarios-mostrar").html(datos).show();
				insertarComentarioBBDD();
				sidebar(); //Esto es para que vuelva a calcular la altura de noticia-left y de sidebar-left; 
			},
			type: "GET",
		});
		
	}
	
	//Para comprobar si existe o no existe la div#comentario-mostrar.
	if($(document).find("#comentarios-mostrar").length)
		mostrarComentarios();
	else
		sidebar();
	
	
});