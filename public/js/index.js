const btn = document.querySelector("#btn-enviar");
    const form = document.querySelector("#registerForm");
    btn.addEventListener("click", (e) =>{
	    e.preventDefault();
	    const datos = new FormData(form);
	    fetch('register',{
		    method: 'post',
		    body:datos
	    })
	    .then(response => response.json())
	    .then(result => {
		    console.log(result)
		    if (result.alerta == "danger") {
			
			    let Nombre = document.querySelector(".errors-Nombre");
			    Nombre.textContent = result.Nombre[0];
			    let Apellido = document.querySelector(".errors-Apellido");
			    Apellido.textContent = result.Apellido[0];
			    let email = document.querySelector(".errors-email");
			    email.textContent = result.email[0];
			    let password = document.querySelector(".errors-password");
			    password.textContent = result.password[0];
			    let confirmarPassword= document.querySelector(".errors-confirmarPassword");
			    confirmarPassword.textContent = result.confirmarpassword[0];
			    let Telefono = document.querySelector(".errors-Telefono");
			    Telefono.textContent = result.Telefono[0];
			    let Direccion = document.querySelector(".errors-Direccion");
			    Direccion.textContent = result.Direccion[0];
			    let CodigoPostal = document.querySelector(".errors-CodigoPostal");
			    CodigoPostal.textContent = result.CodigoPostal[0];
			    let Poblacion = document.querySelector(".errors-Poblacion");
			    Poblacion.textContent = result.Poblacion[0];
          		let Provincia = document.querySelector(".errors-Provincia");
			    Provincia.textContent = result.Provincia[0];
          		let TerminosCondiciones = document.querySelector(".errors-TerminosCondiciones");
			    TerminosCondiciones.textContent = result.TerminosCondiciones[0];
			    let badge = document.querySelectorAll(".badge");
			    badge.forEach(span => { 
				    span.style.display = "block"
				    span.style.textAlign = "left";
			    });
			    setTimeout(() => {
			    badge.forEach(span => { 
				    span.style.display = "none";
			    });
			    }, 3000);
		    }
		    if (result.alerta == "success") {
			    const success = document.querySelector(".alert");
			    success.textContent = "El formulario se valido correctamente";
			    success.style.display = "block";
		    }
		
	    })
    });