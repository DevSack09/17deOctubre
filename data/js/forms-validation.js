document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const progressBar = document.querySelector(".progress-bar");

  const allFields = form.querySelectorAll("input, select, textarea");
  const requiredFields = form.querySelectorAll(
    "input[required], select[required], textarea[required]"
  );
  const totalRequired = () => {
    // Calcular el número de campos requeridos que no están deshabilitados
    return Array.from(requiredFields).filter((field) => !field.disabled).length;
  };

  // Lista de campos que solo deben aceptar números
  const numericFields = [
    "edad",
    "numeroExterior",
    "numeroInterior",
    "cp",
    "numerofijo",
    "confirmarnumerofijo",
    "numeromovil",
    "confirmarnumeromovil",
  ];

  // Lista para rastrear los grupos de radio seleccionados
  const radioGroups = new Set();

  // Referencias a los campos específicos
  const birthdateField = document.getElementById("fechanacimiento");
  const ageField = document.getElementById("edad");
  const phoneField = document.getElementById("numerofijo");
  const confirmPhoneField = document.getElementById("confirmarnumerofijo");
  const mobileField = document.getElementById("numeromovil");
  const confirmMobileField = document.getElementById("confirmarnumeromovil");

  const discapacidadSiField = document.getElementById("discapacidad_si");
  const discapacidadNoField = document.getElementById("discapacidad_no");
  const discapacidadCualField = document.getElementById("discapacidad_cual");
  const tipoDiscapacidadField = document.getElementById("tipo_discapacidad");

  const lenguaSiField = document.getElementById("lengua_si");
  const lenguaNoField = document.getElementById("lengua_no");
  const lenguaCualField = document.getElementById("lengua_cual");

  const comunidadSiField = document.getElementById("comunidad_si");
  const comunidadNoField = document.getElementById("comunidad_no");
  const comunidadCualField = document.getElementById("comunidad_cual");

  const diversidadSiField = document.getElementById("diversidad_si");
  const diversidadNoField = document.getElementById("diversidad_no");
  const diversidadCualField = document.getElementById("diversidad_cual");

  const discapacidadCualLabel = document.querySelector(
    "label[for='discapacidad_cual']"
  );
  const tipoDiscapacidadLabel = document.querySelector(
    "label[for='tipo_discapacidad']"
  );
  const lenguaCualLabel = document.querySelector("label[for='lengua_cual']");
  const comunidadCualLabel = document.querySelector(
    "label[for='comunidad_cual']"
  );
  const diversidadCualLabel = document.querySelector(
    "label[for='diversidad_cual']"
  );

  const menoresSection = document.querySelector("#collapseDocumentosMenores"); // Sección para menores de edad
  const mayoresSection = document.querySelector("#collapseDocumentosAdultos"); // Sección para mayores de edad

  const menoresHeader = document.querySelector("#headingDocumentosMenores");
  const mayoresHeader = document.querySelector("#headingDocumentosAdultos");

  // Ocultar las secciones inicialmente
  menoresSection.classList.remove("show");
  mayoresSection.classList.remove("show");
  menoresHeader.style.display = "none";
  mayoresHeader.style.display = "none";

  // Función para mostrar/ocultar secciones según la edad
  function toggleSectionsByAge(edad) {
    if (!isNaN(edad)) {
      if (edad <= 17) {
        // Mostrar sección para menores de edad
        menoresHeader.style.display = "block";
        menoresSection.classList.add("show");
        mayoresHeader.style.display = "none";
        mayoresSection.classList.remove("show");
      } else if (edad >= 18) {
        // Mostrar sección para mayores de edad
        mayoresHeader.style.display = "block";
        mayoresSection.classList.add("show");
        menoresHeader.style.display = "none";
        menoresSection.classList.remove("show");
      }
    } else {
      // Si la edad es inválida, ocultar ambas secciones
      menoresHeader.style.display = "none";
      mayoresHeader.style.display = "none";
      menoresSection.classList.remove("show");
      mayoresSection.classList.remove("show");
    }
  }

  // Escuchar cambios en el campo "Edad"
  ageField.addEventListener("input", () => {
    const edad = parseInt(ageField.value, 10);
    toggleSectionsByAge(edad);
  });

  // Escuchar cambios en el campo "Fecha de Nacimiento"
  birthdateField.addEventListener("change", () => {
    const birthdateValue = birthdateField.value;
    if (birthdateValue) {
      const edad = calcularEdad(birthdateValue);
      ageField.value = edad >= 0 ? edad : "";
      validarCampo(ageField); // Validar el campo de edad
      toggleSectionsByAge(edad); // Activar lógica para mostrar/ocultar secciones
      actualizarProgreso();
    }
  });

  // Función para calcular la edad a partir de la fecha de nacimiento
  function calcularEdad(fechaNacimiento) {
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
      edad--;
    }

    return edad;
  }

  // Función para habilitar o deshabilitar los campos de discapacidad
  function toggleDiscapacidadFields() {
    if (discapacidadSiField.checked) {
      discapacidadCualField.disabled = false;
      discapacidadCualField.required = true;
      agregarAsterisco(discapacidadCualLabel);

      tipoDiscapacidadField.disabled = false;
      tipoDiscapacidadField.required = true;
      agregarAsterisco(tipoDiscapacidadLabel);
    } else if (discapacidadNoField.checked) {
      limpiarYDeshabilitarCampo(discapacidadCualField, discapacidadCualLabel);
      limpiarYDeshabilitarCampo(tipoDiscapacidadField, tipoDiscapacidadLabel);
    }
    actualizarProgreso();
  }

  // Función para habilitar o deshabilitar los campos de lengua indígena
  function toggleLenguaFields() {
    if (lenguaSiField.checked) {
      lenguaCualField.disabled = false;
      lenguaCualField.required = true;
      agregarAsterisco(lenguaCualLabel);
    } else if (lenguaNoField.checked) {
      limpiarYDeshabilitarCampo(lenguaCualField, lenguaCualLabel);
    }
    actualizarProgreso();
  }

  // Función para habilitar o deshabilitar el campo ¿Cuál? de comunidad indígena
  function toggleComunidadCualField() {
    if (comunidadSiField.checked) {
      comunidadCualField.disabled = false;
      comunidadCualField.required = true;
      agregarAsterisco(comunidadCualLabel);
    } else if (comunidadNoField.checked) {
      limpiarYDeshabilitarCampo(comunidadCualField, comunidadCualLabel);
    }
    actualizarProgreso();
  }

  // Función para habilitar o deshabilitar el campo ¿Cuál? de diversidad sexual y de género
  function toggleDiversidadCualField() {
    if (diversidadSiField.checked) {
      diversidadCualField.disabled = false;
      diversidadCualField.required = true;
      agregarAsterisco(diversidadCualLabel);
    } else if (diversidadNoField.checked) {
      limpiarYDeshabilitarCampo(diversidadCualField, diversidadCualLabel);
    }
    actualizarProgreso();
  }

  // Función para limpiar y deshabilitar un campo
  function limpiarYDeshabilitarCampo(campo, label) {
    campo.value = "";
    campo.disabled = true;
    campo.required = false;
    quitarAsterisco(label);
    campo.classList.remove("is-valid", "is-invalid");
  }

  // Función para agregar el asterisco de requerido
  function agregarAsterisco(label) {
    if (!label.querySelector(".required")) {
      const asterisco = document.createElement("span");
      asterisco.classList.add("required");
      asterisco.textContent = "*";
      label.appendChild(asterisco);
    }
  }

  // Función para quitar el asterisco de requerido
  function quitarAsterisco(label) {
    const asterisco = label.querySelector(".required");
    if (asterisco) {
      label.removeChild(asterisco);
    }
  }

  // Escuchar cambios en los radio buttons para activar/desactivar los campos
  discapacidadSiField.addEventListener("change", toggleDiscapacidadFields);
  discapacidadNoField.addEventListener("change", toggleDiscapacidadFields);

  lenguaSiField.addEventListener("change", toggleLenguaFields);
  lenguaNoField.addEventListener("change", toggleLenguaFields);

  comunidadSiField.addEventListener("change", toggleComunidadCualField);
  comunidadNoField.addEventListener("change", toggleComunidadCualField);

  diversidadSiField.addEventListener("change", toggleDiversidadCualField);
  diversidadNoField.addEventListener("change", toggleDiversidadCualField);

  // Escuchar cambios en Fecha de nacimiento para calcular Edad automáticamente
  if (birthdateField && ageField) {
    birthdateField.addEventListener("change", () => {
      const birthdateValue = birthdateField.value;
      if (birthdateValue) {
        const age = calcularEdad(birthdateValue);
        ageField.value = age >= 0 ? age : "";
        validarCampo(ageField);
        actualizarProgreso();
      }
    });
  }

  const radioButtons = form.querySelectorAll("input[type='radio']");
  radioButtons.forEach((radio) => {
    radio.addEventListener("change", manejarCambioRadio);
  });

  function manejarCambioRadio(event) {
    const field = event.target;
    const groupName = field.name;

    if (field.checked) {
      radioGroups.add(groupName);
    }

    actualizarProgreso();
  }

  // Validar que número fijo y móvil coincidan con sus respectivas confirmaciones
  function validarConfirmacionTelefonos() {
    let isValid = true;

    // Validar número fijo
    if (phoneField.value !== confirmPhoneField.value) {
      confirmPhoneField.classList.add("is-invalid");
      confirmPhoneField.classList.remove("is-valid");
      isValid = false;
    } else {
      confirmPhoneField.classList.remove("is-invalid");
      confirmPhoneField.classList.add("is-valid");
    }

    // Validar número móvil
    if (mobileField.value !== confirmMobileField.value) {
      confirmMobileField.classList.add("is-invalid");
      confirmMobileField.classList.remove("is-valid");
      isValid = false;
    } else {
      confirmMobileField.classList.remove("is-invalid");
      confirmMobileField.classList.add("is-valid");
    }

    return isValid;
  }

  [phoneField, confirmPhoneField, mobileField, confirmMobileField].forEach(
    (field) => {
      field.addEventListener("input", () => {
        validarConfirmacionTelefonos();
        actualizarProgreso();
      });
    }
  );

  allFields.forEach((field) => {
    const eventType = field.tagName === "SELECT" ? "change" : "input";

    if (numericFields.includes(field.id)) {
      field.addEventListener("input", () => {
        field.value = field.value.replace(/[^\d]/g, "");
      });
    }

    field.addEventListener(eventType, () => {
      validarCampo(field);
      actualizarProgreso();
    });

    field.addEventListener("blur", () => {
      validarCampo(field);
      actualizarProgreso();
    });
  });

  function validarCampo(field) {
    const value = field.value.trim();
    const minLength = field.getAttribute("minlength");
    const maxLength = field.getAttribute("maxlength");
    const inputContainer =
      field.closest(
        ".col-md-2, .col-md-3, .col-md-4, .col-md-6, .form-group"
      ) || field.parentElement;

    const invalidFeedbacks =
      inputContainer.querySelectorAll(".invalid-feedback");
    const validFeedback = inputContainer.querySelector(".valid-feedback");

    let isValid = true;

    if (field.hasAttribute("required") && !value && field.type !== "checkbox") {
      mostrarSoloEsteFeedback(invalidFeedbacks[0], inputContainer);
      isValid = false;
    } else if (
      value &&
      ((minLength && value.length < minLength) ||
        (maxLength && value.length > maxLength))
    ) {
      mostrarSoloEsteFeedback(invalidFeedbacks[1], inputContainer);
      isValid = false;
    } else if (
      [
        "numerofijo",
        "confirmarnumerofijo",
        "numeromovil",
        "confirmarnumeromovil",
      ].includes(field.id) &&
      value.length !== 10
    ) {
      mostrarSoloEsteFeedback(invalidFeedbacks[1], inputContainer);
      isValid = false;
    }

    if (isValid) {
      ocultarTodosLosFeedbacks(inputContainer);
      if (validFeedback && value !== "") validFeedback.classList.add("d-block");
      field.classList.remove("is-invalid");
      if (value !== "" || field.type === "checkbox") {
        field.classList.add("is-valid");
      } else {
        field.classList.remove("is-valid");
      }
    } else {
      if (validFeedback) validFeedback.classList.remove("d-block");
      field.classList.remove("is-valid");
      field.classList.add("is-invalid");
    }
  }

  function mostrarSoloEsteFeedback(feedback, container) {
    ocultarTodosLosFeedbacks(container);
    if (feedback) feedback.classList.add("d-block");
  }

  function ocultarTodosLosFeedbacks(container) {
    const feedbacks = container.querySelectorAll(
      ".invalid-feedback, .valid-feedback"
    );
    feedbacks.forEach((fb) => fb.classList.remove("d-block"));
  }

  function actualizarProgreso() {
    let completados = 0;

    requiredFields.forEach((field) => {
      if (field.type === "radio") {
        const groupName = field.name;
        if (radioGroups.has(groupName)) {
          completados++;
        }
      } else if (
        field.classList.contains("is-valid") ||
        (field.type === "checkbox" && field.checked)
      ) {
        completados++;
      }
    });

    const porcentaje = Math.round((completados / totalRequired()) * 100);
    progressBar.style.width = `${porcentaje}%`;
    progressBar.setAttribute("aria-valuenow", porcentaje);
    progressBar.textContent = `${porcentaje}%`;
  }

  function calcularEdad(fechaNacimiento) {
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
      edad--;
    }

    return edad;
  }
});
