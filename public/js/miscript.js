let boton = document.getElementById("boton");
let span = document.getElementById("respuesta");
let form = document.getElementById("formulario");
let div = document.querySelector(".isa_success");
let icono = document.querySelector(".fa fa-check");
let nombre = document.getElementById("formulario_nombre");
boton.addEventListener("click", afterDemo);
function afterDemo() {
  let data = {
    nombre: document.getElementById("formulario_nombre").value,
    email: document.getElementById("formulario_email").value,
    ciudad: document.getElementById("formulario_ciudad").value,
  };

  if (data.nombre != "" && data.email != "" && data.ciudad != "") {
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
  }
  event.preventDefault();
}
