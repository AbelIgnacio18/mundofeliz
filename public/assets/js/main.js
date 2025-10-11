var boton = document.getElementById("boton");

function traer() {
    var dni = document.getElementById("dni").value;
    fetch(
      "https://apiperu.dev/api/dni/" + dni + "?api_token=b9fd0cbf582731fd85f7eca7768cf5aec687380f976e976dac898103457c2cb2"
    )
        .then((res) => res.json())
        .then((data) => {
            
            document.getElementById("nombre").value = data.data.nombres;
            document.getElementById("apellidop").value =
                data.data.apellido_paterno;
            document.getElementById("apellidom").value =
                data.data.apellido_materno;
            document.getElementById("doc").value = data.data.numero;
        });
}
boton.addEventListener("click", traer);
