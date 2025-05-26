const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	password: /^.{8,20}$/, // 8 a 20 dígitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	
};

const campos = {
	password: false,
	correo: false,
};

const validarFormulario = (e) => {
	validarCampo(e.target);
};

const validarCampo = (input) => {
	// Eliminar espacios en blanco al inicio
	input.value = input.value.trimStart();
	
	const campo = input.name;
	const expresion = expresiones[campo];

	if (input.value.trim() === "") {
		mostrarError(campo, `Falta teclear ${campo === 'correo' ? 'correo' : 'contraseña'}`);
		campos[campo] = false;
	} else if (expresion.test(input.value)) {
		limpiarError(campo);
		campos[campo] = true;
	} else {
		mostrarError(campo, campo === 'correo' ? 'Formato de correo incorrecto correo@ejemplo.com' : 'La contraseña debe tener entre 8 y 20 caracteres');
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