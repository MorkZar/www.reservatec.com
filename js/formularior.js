document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById("formulario");
    const inputs = document.querySelectorAll("#formulario input:not([type='hidden'])");
    const selectTipo = document.getElementById('tipo');
    const campoAdicional = document.getElementById('campoAdicional');
    const inputAdicional = document.getElementById('nombreAdicional');
  
    const expresiones = {
      nombre: /^[a-zA-ZÀ-ÿ\s]{1,30}$/,
      ap_paterno: /^[a-zA-ZÀ-ÿ\s]{1,30}$/,
      ap_materno: /^[a-zA-ZÀ-ÿ\s]{1,30}$/,
      nombreAdicional: /^[A-Za-záéíóúÁÉÍÓÚ0-9\s]{1,30}$/,
      password: /^.{8,20}$/,
      correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
    };
  
    const campos = {
      nombre: false,
      ap_paterno: false,
      ap_materno: false,
      nombreAdicional: true, // Inicialmente true porque no es requerido
      password: false,
      correo: false,
    };
  
    // Función para mostrar errores
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
  
    // Función para limpiar errores
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
  
    // Función para validar cada campo
    const validarCampo = (input) => {
      const campo = input.name;
      input.value = input.value.trimStart();
  
      // Si es nombreAdicional y no está visible, no validar
      if (campo === "nombreAdicional" && campoAdicional.style.display === "none") {
        limpiarError(campo);
        campos[campo] = true;
        return;
      }
  
      const expresion = expresiones[campo];
  
      if (input.value.trim() === "") {
        // Solo mostrar error si es requerido (visible)
        if (campo === "nombreAdicional" && campoAdicional.style.display === "block") {
          mostrarError(campo, `Falta teclear el nombre de la organización`);
          campos[campo] = false;
        } else if (campo !== "nombreAdicional") {
          mostrarError(campo, `Falta teclear ${campo.replace('_', ' ')}`);
          campos[campo] = false;
        }
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
  
    // Event listeners para los inputs
    inputs.forEach((input) => {
      input.addEventListener('keyup', function() {
        validarCampo(this);
      });
      input.addEventListener('blur', function() {
        validarCampo(this);
      });
      input.addEventListener('input', function(e) {
        if (e.target.value.startsWith(" ")) {
          e.target.value = e.target.value.trimStart();
        }
      });
    });
  
    // Event listener para el select
    selectTipo.addEventListener('change', function() {
      if (this.value === '3' || this.value === '4') {
        campoAdicional.style.display = 'block';
        inputAdicional.setAttribute('required', 'required');
        campos.nombreAdicional = false; // Resetear para validación
      } else {
        campoAdicional.style.display = 'none';
        inputAdicional.removeAttribute('required');
        inputAdicional.value = '';
        limpiarError('nombreAdicional');
        campos.nombreAdicional = true; // Marcar como válido
      }
    });
  
    // Event listener para el submit
    formulario.addEventListener('submit', function(e) {
      e.preventDefault();
      let formValido = true;
  
      // Validar todos los campos visibles
      inputs.forEach((input) => {
        // No validar campos ocultos
        if (input.name === "nombreAdicional" && campoAdicional.style.display === "none") {
          return;
        }
        
        validarCampo(input);
        if (!campos[input.name]) {
          formValido = false;
        }
      });
  
      if (formValido) {
        // Si todo está válido, enviar el formulario
        this.submit();
      } else {
        // Mostrar mensaje de error general si es necesario
        console.log('Por favor complete correctamente todos los campos requeridos');
      }
    });
  
    // Validar el estado inicial del select al cargar la página
    if (selectTipo.value === '3' || selectTipo.value === '4') {
      campoAdicional.style.display = 'block';
      inputAdicional.setAttribute('required', 'required');
    }
  });