// Manter label a cima do input
for (let x of document.querySelectorAll("input"))
{
  x.addEventListener("input", e=>subirLabel(e))
}

function subirLabel(e)
{
  if(e.target.value != "")
  {
    e.target.parentNode.querySelector("label")
    .classList.add("label-hover");
  } else
    {
      e.target.parentNode.querySelector("label")
      .classList.remove("label-hover");
    }
}

// Mostrar aviso (Tela de registro)
document.querySelector("#acesso-input-aviso-icone")
.addEventListener("click", ()=>
{
  document.querySelector("#id").classList.toggle("avisoAtivo");
})



// MOSTRAR CIDADE CORRESPONDENTE AO UF
// Remove a visibilidade de todos os select Cidade
function desmarcarCidades()
{
  let cidades = document.querySelectorAll(".cidades");

  for (var i = 0; i < cidades.length; i++)
  {
    cidades[i].classList.remove("cidade-visivel");
  }
}

//
document.querySelector("#uf")
.addEventListener("change", (e)=>
{
  switch (e.target.value)
  {
    case "tudo":
      desmarcarCidades();
      break;

    case "AC":
      desmarcarCidades();
      document.querySelector(".ac")
      .classList.add("cidade-visivel");
      break;

    case "AL":
      desmarcarCidades();
      document.querySelector(".al")
      .classList.add("cidade-visivel");
      break;

    case "AP":
      desmarcarCidades();
      document.querySelector(".ap")
      .classList.add("cidade-visivel");
      break;

    case "AM":
      desmarcarCidades();
      document.querySelector(".am")
      .classList.add("cidade-visivel");
      break;

      case "BA":
        desmarcarCidades();
        document.querySelector(".ba")
        .classList.add("cidade-visivel");
        break;
  }
})
