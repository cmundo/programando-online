<div style='padding-top:6px'><h2 style='display:inline;border-bottom:1px solid #007095;color:#007095'>Contacto</h2></div>

<p style='margin-top:20px;'>Si deseas ponerte en contacto con nosotros rellena este formulario. Te contestaremos lo más rápido posible.</p>

<div id="formContenedor">
	<form id="formulario">
		<div id="transparencia">
			<div id="transparenciaMensaje">Transparencia de Capa</div>
		</div>
		<table>
			<tbody>
				<tr>
					<td class="ayuda"><img src="img/formulario/ayuda.png" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
					<td class="label">Nombre:</td>
					<td class="campo"><input class="inputNormal" type="text" id="inputNombre" autofocus='autofocus' style='width:300px;height:35px;'></td>
				</tr>
				<tr>
					<td class="ayuda"><img src="img/formulario/ayuda.png" alt="Ayuda" onmouseover="muestraAyuda(event, 'Correo')"></td>
					<td class="label">Mail:</td>
					<td class="campo"><input class="inputNormal" type="text" id="inputCorreo" style='width:300px;height:35px;' ></td>
				</tr>
				<tr>
					<td class="ayuda" style='vertical-align:top;padding-top:10px'><img src="img/formulario/ayuda.png" alt="Ayuda" onmouseover="muestraAyuda(event, 'Comentario')"></td>
					<td class="label" style='vertical-align:top;padding-top:10px'>Comentarios:</td>
					<td class="campo"><textarea class="inputNormal" id="inputComentario"></textarea></td>
				</tr>
			</tbody>
		</table>
		<br>
		<div id='botones'>
			<button id="enviar_formulario" onClick="validaForm()" type="button"></button>
			<button type="reset" id='borrar_formulario'></button>
		</div>
	</form>
</div>

<!-- Capa para mostrar los mensajes de ayuda al presionar los iconos correspondientes -->
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>

<div style='clear:both'></div>

