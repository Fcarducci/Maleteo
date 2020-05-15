//? FORMULARIO DE SOLICITAR DEMO:

let boton = document.getElementById("boton");
let span = document.getElementById("respuesta");
let form = document.getElementById("formulario");
let div = document.querySelector(".isa_success");
let icono = document.querySelector(".fa fa-check");
let nombre = document.getElementById("formulario_nombre");
let inputCheck = document.getElementById("formulario_politica");
form.addEventListener("submit", afterDemo);
function afterDemo() {
  // if (confirm("Completa los campos correctamente")) {
  // if (form.submit()) {
  let data = {
    nombre: document.getElementById("formulario_nombre").value,
    email: document.getElementById("formulario_email").value,
    ciudad: document.getElementById("formulario_ciudad").value,
  };
  console.log(data);

  // if (data.nombre != "" && data.email != "" && data.ciudad != "" && inputCheck.checked) {
  fetch("/demo/submit", {
    method: "POST",
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((contenido) => {
      span.innerHTML = contenido.msg;
      div.setAttribute("style", "display: block");
      form.reset();
    });
  // }
  event.preventDefault();
  // }

  // }
}

//? FORMULARIO DE REGISTRO

// let inputEmailRegistro = document.querySelector(".form-signin");
// let divError = document.querySelector(".isa_error");
// inputEmailRegistro.addEventListener("submit", mostrarError);
// function mostrarError() {
//   divError.setAttribute("style", "display:block");
// }
