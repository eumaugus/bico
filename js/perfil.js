let botaoEditar = document.querySelector(".perfil-editar");

botaoEditar
.addEventListener("click", ()=>
{
  // botaoEditar.inner = "cancel";
  let campos = document.querySelectorAll(".perfil-campo");
  for (var campo of campos)
  {
    campo.removeAttribute("disabled");
    campo.classList.remove("perfil-campo");
  }
})


let x = 0;

document.querySelector("#senha-visao")
.addEventListener("click", ()=>
{
  if(!document.querySelector("#senha-visao").hasAttribute("disabled"))
  {
    let senha = document.querySelector("#senha-campo");
    x++

    if(x % 2 == 0)
    {
      senha.setAttribute("type", "password");
    }

    else
    {
      senha.setAttribute("type", "text");
    }
  }
})
