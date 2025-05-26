const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
    ap_paterno: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
    ap_materno: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
    nombreAdicional: /^[A-Za-záéíóúÁÉÍÓÚ0-9\s]{1,30}$/, // Letras, números y espacios, pueden llevar acentos.
    password: /^.{8,20}$/, // Entre 8 y 20 caracteres.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/ // Formato de correo válido.
};

const campos = {
    nombre: false,
    ap_paterno: false,
    ap_materno: false,
    nombreAdicional: false,
    password: false,
    correo: false,
};

const validarFormulario = (e) => {
    validarCampo(e.target);
};

const validarCampo = (input) => {
    input.value = input.value.trimStart(); // Eliminar espacios en blanco al inicio
    const campo = input.name;
    const expresion = expresiones[campo];

    if (input.value.trim() === "") {
        mostrarError(campo, `Falta Teclear ${campo.replace('_', ' ')} `);
        campos[campo] = false;
    } else if (expresion.test(input.value)) {
        limpiarError(campo);
        campos[campo] = true;
    } else {
        let mensajeError = "Formato inválido.";
        switch (campo) {
            case "correo":
                mensajeError = "Formato de correo incorrecto. Ejemplo: correo@ejemplo.com";
                break;
            case "password":
                mensajeError = "La contraseña debe tener entre 8 y 20 caracteres.";
                break;
            case "nombre":
            case "ap_paterno":
            case "ap_materno":
                mensajeError = "Solo se permiten letras y espacios.";
                break;
            case "nombreAdicional":
                mensajeError = "Solo se permiten letras, números y espacios.";
                break;
        }
        mostrarError(campo, mensajeError);
        campos[campo] = false;
    }
};

const mostrarError = (campo, mensaje) => {
	const grupo = document.getElementById(`grupo__${campo}`);
	grupo.classList.add('formulario__grupo-incorrecto');
	grupo.classList.remove('formulario__grupo-correcto');
	document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
	document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
	const errorTexto = document.querySelector(`#grupo__${campo} .formulario__input-error`);
	errorTexto.textContent = mensaje;
	errorTexto.classList.add('formulario__input-error-activo');
};

const limpiarError = (campo) => {
	const grupo = document.getElementById(`grupo__${campo}`);
	grupo.classList.remove('formulario__grupo-incorrecto');
	grupo.classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
	const errorTexto = document.querySelector(`#grupo__${campo} .formulario__input-error`);
	errorTexto.textContent = "";
	errorTexto.classList.remove('formulario__input-error-activo');
};

// Evitar que el usuario escriba espacios en blanco al inicio
const prevenirEspaciosAlInicio = (e) => {
	if (e.target.value.startsWith(" ")) {
		e.target.value = e.target.value.trimStart();
	}
};

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.addEventListener('input', prevenirEspaciosAlInicio); // Evitar espacios en blanco al inicio
});

// Validación antes de enviar el formulario
formulario.addEventListener('submit', (e) => {
	let formValido = true;

	inputs.forEach((input) => {
		validarCampo(input);
		if (!campos[input.name]) {
			formValido = false;
		}
	});

	if (!formValido) {
		e.preventDefault(); // Evita que el formulario se envíe si hay errores
	}
});

// Seleccionamos el elemento <select> y el div que contiene el campo adicional
const selectTipo = document.getElementById('tipo');
const campoAdicional = document.getElementById('campoAdicional');
const inputAdicional = document.getElementById('nombreAdicional');  // Seleccionamos el campo de texto dentro de 'campoAdicional'

// Escuchamos el evento 'change' en el <select>
selectTipo.addEventListener('change', function() {
    console.log("Seleccionado: " + selectTipo.value); // Para verificar que el valor cambia correctamente
    // Asegúrate de que los valores de 'empresa' y 'institucionExterna' coincidan exactamente con los valores en la base de datos.
    if (selectTipo.value === '3' || selectTipo.value === '4') {
        // Mostrar el campo adicional y hacerlo obligatorio
        campoAdicional.style.display = 'block';  
        inputAdicional.setAttribute('required', 'required');  // Hacer el campo adicional obligatorio
    } else {
        // Ocultar el campo adicional y quitar el obligatorio
        campoAdicional.style.display = 'none';  
        inputAdicional.removeAttribute('required');  // Quitar el atributo 'required'
    }
});
