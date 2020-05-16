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

// let a = document.getElementsByClassName("enlace");
// console.log(a);
// let id = document.getElementsByClassName("id");
// console.log(id);
// let comentario = document.getElementsByClassName("comentario");
// console.log(comentario);
// let autor = document.getElementsByClassName("autor");
// console.log(autor);
// let ciudad = document.getElementsByClassName("ciudad");
// console.log(ciudad);

// for (let i = 0; i < a.length; i++) {
//   a[i].addEventListener("click", borrar);
//   function borrar(e) {
//     let datos = {
//       id: id[i].innerText,
//       comentario: comentario[i].innerText,
//       autor: autor[i].innerText,
//       ciudad: ciudad[i].innerText,
//     };
//     console.log(datos);
//     // let url = e.currentTarget.href;
//     fetch(url).then((response) => console.log(response));
//     event.preventDefault();
//   }
// }
