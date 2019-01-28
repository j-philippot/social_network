const titulo = document.querySelector(".tituloPublicacion");
const boton = document.querySelector(".botonPublicar");
const fondo = document.querySelector(".fondoModal");
const publicar = document.querySelector(".publicar");
const output = document.querySelector(".output");
const cancelar = document.querySelector(".cancelar");
const archivo = document.querySelector(".inputfile");
const formulario = document.querySelector("#formularioPost");
const divBorrar = document.querySelector(".borrar");
const cancelarBorrar = document.querySelector(".noBorrar");

function modalOn() {
	titulo.classList.add("activo");
	boton.classList.add("activo");
	fondo.classList.add("activo");
	publicar.classList.add("relativo");
}

function modalOff() {
	formulario.reset();
	output.src= "";
    cancelar.style.display = "none";
	titulo.classList.remove("activo");
	boton.classList.remove("activo");
	fondo.classList.remove("activo");
	publicar.classList.remove("relativo");
	// Volver arriba: scroll(0,0);
}

function autoExpand(field) {
	// Reseteamos la altura del campo de texto:
	field.style.height = 'inherit';

	// Recuperamos los estilos computados del campo de texto:
	var computed = window.getComputedStyle(field);

	// Calculamos la altura:
	var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
	             + parseInt(computed.getPropertyValue('padding-top'), 10)
	             + field.scrollHeight
	             + parseInt(computed.getPropertyValue('padding-bottom'), 10)
	             + parseInt(computed.getPropertyValue('border-bottom-width'), 10);
	// Aumentamos la altura para adaptarla al contenido:
	field.style.height = height + 'px';
}

function loadFile(event) {
	modalOn();
    output.src = URL.createObjectURL(event.target.files[0]);
    cancelar.style.display = "block";
    cancelar.addEventListener("click", function() {
    	output.src= "";
    	archivo.value = "";
    	cancelar.style.display = "none";
    });
}

function borrar() {
	fondo.classList.add("activo");
	divBorrar.style.display = "flex";
	cancelarBorrar.addEventListener("click", function() {
		fondo.classList.remove("activo");
		divBorrar.style.display = "none";
	});
}