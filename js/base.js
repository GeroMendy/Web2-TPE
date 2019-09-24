document.addEventListener("DOMContentLoaded",function(){
  "use strict";

  <!--  Constante/s para Rest  -->
  const SERVER = "http://web-unicen.herokuapp.com/api/";
  const GRUPO_COLECCION = "groups/G70-Mendy-Larrondo/lanzamientos/";
  const BOTON_ELIMINAR = "<div class=eliminarLanzamiento><a href=#><img src=../img/cruz.svg></a></div>";
  const BOTON_MODIFICAR = "<div class=modificarLanzamiento><a href=#><img src=../img/editar.svg></a></div>";
  <!--  Constante/s para cambiarContenido() y cambiarPerfilJuego()  -->
  const NOT_FOUNDED = "<h2 class=fallo>Contenido no encontrado</h2>  <img class=fallo src=../img/notFounded.svg>";
  const CONNECTION_FAIL = "<h2 class=fallo>Fallo de conecci&oacuten</h2>";

  <!--  Variable/s para destacarHoverMenuNav()  -->
  let menu_nav_btn = document.querySelector(".js_menu-btn");

  <!--  Variable/s para cambiarContenido() -->
  let contenedor = document.querySelector(".content");
  let cargando = document.querySelector(".cargando");

  <!--  Variable/s para filtrarLanzamientosPlataforma() -->
  let disponiblePC = [];
  let disponiblePS4 = [];
  let disponibleXbox = [];
  let disponibleSwitch = [];

  //Para que empiece en home
  cambiarContenido(0);

  <!--  Listenner/s para cambiarContenido() -->
  document.querySelector(".navbar-brand").addEventListener("click",function () {cambiarContenido(0)});
  let seccionNav = document.querySelectorAll(".nav-link");
  for (let i = 0; i < seccionNav.length; i++) {
    seccionNav[i].addEventListener("click",function () {cambiarContenido(i+1)});
  };

  <!--  Listenner/s para destacarHoverMenuNav() -->
  menu_nav_btn.addEventListener("mouseover",function () {destacarHoverMenuNav(true)});
  menu_nav_btn.addEventListener("mouseout",function () {destacarHoverMenuNav(false)});

  function destacarHoverMenuNav(hoverMenuNav){
    if(hoverMenuNav){
      menu_nav_btn.src="../img/menu-nav-hover.svg";
    }
    else {
      menu_nav_btn.src="../img/menu-nav.svg";
    }
  }

  function cambiarContenido(seccion){
    console.log("seccion : "+seccion);
    let url;
    switch (seccion) {
      case 0:
      url = "home";
      break;
      case 3:
      url = "contacto";
      break;
      case 4:
      url = "lanzamientos";
      break;
      case 5:
      url = "memotest";
      break;
      default:
      url = "juego" + (seccion-5);
      break;
    }
    fetch(url + ".html").then(response=>{
      cargando.classList.add("hidden");
      if(response.ok){
        response.text().then(t =>{
          contenedor.innerHTML = t;
          if(seccion===4){
            actualizarTablaLanzamientos();
            filtrarLanzamientosPlataforma(0);
            contenedor.querySelector("#post-juego").addEventListener("click",function(){validarLanzamientoJuego()});
            contenedor.querySelector("#js-post-multiples-juegos").addEventListener("click",function () {generarMultiplesLanzamientos()});
            let filtroPlataforma = contenedor.querySelectorAll(".filtroPlataforma");
            for (let i = 0; i < filtroPlataforma.length; i++) {
              filtroPlataforma[i].addEventListener("click",function () {filtrarLanzamientosPlataforma(i)});
            }
            let juegos = contenedor.querySelectorAll(".js-juego");
            for (let i = 0; i < juegos.length; i++) {
              juegos[i].addEventListener("click",function () {cambiarContenido(i+6)})
            }
          }else if (seccion===5) {
            ejecutarJSMemotest();
          }
        })
      }
      else{
        contenedor.innerHTML = NOT_FOUNDED;
      }
    })
    .catch(response=>{
      contenedor.innerHTML = CONNECTION_FAIL;
      cargando.classList.add("hidden");
    });
    cargando.classList.remove("hidden");
  }

  function validarLanzamientoJuego(){
    let dataJuego = document.querySelectorAll(".js-cargaLanzamiento");
    console.log("valido-0");
    let juego = {
      "nombre" : dataJuego[0].value,
      "fecha" : dataJuego[1].value,
      "plataforma" : dataJuego[2].value
    }
    if ((juego.nombre!=="")&&(juego.fecha!=="")&&(juego.plataforma!=="")) {
      if ((juego.fecha>0)&&(juego.fecha<32)) {
        let objeto = {
          "thing" : juego
        }
        console.log("valido-1");
        console.log(objeto);
        registrarLanzamientoJuego(objeto);
      }else {
        console.log("fecha erronea");
      }
    }else {
      console.log("Dato del juego incompletos");
    }
    for (let i = 0; i < dataJuego.length; i++) {
      dataJuego[i].value = null;
    }
  }

  function generarMultiplesLanzamientos(){
    let cant = document.querySelector("#cantJuegos").value;
    let nombre = "nuevo juego ";
    let fecha = 0;
    let plataforma = "pc";
    let juego;
    for (let i = 0; i < cant; i++) {
      juego = {
        "nombre" : nombre,
        "fecha" : fecha,
        "plataforma" : plataforma
      }
      let objeto = {
        "thing" : juego
      }
      registrarLanzamientoJuego(objeto);
    }
  }

  function registrarLanzamientoJuego(objeto){
    let url = SERVER+GRUPO_COLECCION;
    console.log("post-0");
    fetch(url,{
      method : 'POST',
      headers: {
        'Content-Type' : 'application/json'
      },
      body : JSON.stringify(objeto)
    })
    .then(r => {
      console.log("post-1");
      actualizarTablaLanzamientos()
    });
  }

  function actualizarTablaLanzamientos(){
    let url = SERVER+GRUPO_COLECCION;
    let tbody = document.querySelector("#js-tbodyLanzamientos");
    let botonesBorrar;
    let botonesModificar;
    let tfoot = document.querySelector("#js-tfootLanzamientos");
    fetch(url).then(r => r.json())
    .then(json => {
      let idGuardadas=[];
      let columnas = "La tabla de lanzamientos esta vacia";
      let obj = json.lanzamientos;
      ordenarLanzamientos(obj);
      for (let i = 0; i < obj.length; i++) {
        idGuardadas[i] = obj[i]._id;
        if(i===0){
          columnas = "";
        }
        let objeto = obj[i].thing;
        columnas = columnas+"<tr class=js-tr-lanzamiento><td>"+BOTON_ELIMINAR+objeto.nombre+"</td><td>"+objeto.fecha+"</td><td>"+objeto.plataforma+BOTON_MODIFICAR+"</td></tr>";
      };
      if ((obj.length%2)===0) {
        tfoot.classList.add("bg-tfoot")
      }else {
        tfoot.classList.remove("bg-tfoot")
      }
      tbody.innerHTML = columnas;
      botonesBorrar = document.querySelectorAll(".eliminarLanzamiento");
      botonesModificar = document.querySelectorAll(".modificarLanzamiento");
      for (let i = 0; i < botonesBorrar.length; i++) {
        botonesBorrar[i].addEventListener("click",function(){eliminarLanzamiento(idGuardadas[i])});
      }
      console.log("botonesBorrar : "+botonesBorrar.length);
      for (let i = 0; i < botonesModificar.length; i++) {
        botonesModificar[i].addEventListener("click",function(){permitirModificarLanzamientoJuego(idGuardadas[i],obj[i].thing)});
      }
      console.log("botonesModificar : " + botonesModificar.length);
      buscarDisponibilidad(obj);
      console.log("get-1");

    })
    .catch(error => tbody.innerHTML = error);
    console.log("get-0");
  }

  function eliminarLanzamiento(id){
    let url = SERVER+GRUPO_COLECCION+id;
    console.log(url);
    fetch(url,{
      method : 'DELETE',
      headers : {
        'Content-Type' : 'application/json'
      }
    }).then(function () {
      console.log("delete-1");
      actualizarTablaLanzamientos();
    })
    console.log("delete-0");
  }

  function ordenarLanzamientos(obj){
    console.log("sort-0");
    let aux,a,b;
    for (let i = 0; i <obj.length; i++) {
      for (let j = 0; j <(obj.length-1); j++) {
        a = parseInt(obj[j].thing.fecha);
        b = parseInt(obj[j+1].thing.fecha);
        if (a>b) {
          aux = obj[j];
          obj[j] = obj[j+1];
          obj[j+1] = aux;
        }
      }
    }
    console.log("sort-1");
  }

  function permitirModificarLanzamientoJuego(id,thing){
    let botonAgregar = document.querySelector("#post-juego");
    let botonModificar = document.querySelector("#put-juego");
    let dataJuego = document.querySelectorAll(".js-cargaLanzamiento");
    botonAgregar.disabled = true;
    botonModificar.disabled = false;
    dataJuego[0].value = thing.nombre;
    dataJuego[1].value = thing.fecha;
    dataJuego[2].value = thing.plataforma;
    document.querySelector("#put-juego").addEventListener("click",function () {modificarLanzamientoJuego(id)});
  }
  function modificarLanzamientoJuego(id){
    console.log("put-0");
    let url = SERVER+GRUPO_COLECCION+id;
    let dataJuego = document.querySelectorAll(".js-cargaLanzamiento");
    let lanzamiento = {
      "nombre" : dataJuego[0].value,
      "fecha" : dataJuego[1].value,
      "plataforma" : dataJuego[2].value
    }
    let objeto = {
      "thing" : lanzamiento
    }
    fetch(url,{
      method : 'PUT',
      headers: {
        'Content-Type' : 'application/json'
      },
      body : JSON.stringify(objeto)
    }).then(r =>{
      console.log("put-1");
      actualizarTablaLanzamientos();
    })
    for (let i = 0; i < dataJuego.length; i++) {
      dataJuego[i].value = null;
    }
    document.querySelector("#post-juego").disabled = false;
    document.querySelector("#put-juego").disabled = true;
  }

  function filtrarLanzamientosPlataforma(plataforma){
    let url;
    let disponible = [];
    switch (plataforma) {
      case 1:
        disponible = disponiblePC;
        break;
      case 2:
        disponible = disponiblePS4;
        break;
      case 3:
        disponible = disponibleXbox;
        break;
      case 4:
        disponible = disponibleSwitch;
        break;
    }
    let imgFiltro = document.querySelectorAll(".js-imagen-filtro");
    let trLanzamientos = document.querySelectorAll(".js-tr-lanzamiento");
    for (let i = 0; i < imgFiltro.length; i++) {
      url = "../img/filtro_lanzamientos/filtro"+i+".svg";
      if (i===plataforma) {
        url = "../img/filtro_lanzamientos/filtro"+i+"-activo.svg"
      }
      imgFiltro[i].src = url;
    }
    console.log(disponible);
    console.log(trLanzamientos);
    if (plataforma===0) {
      for (let i = 0; i < trLanzamientos.length; i++) {
        trLanzamientos[i].classList.remove("filtro-lanzamientos");
      }
    }else{
      for (let i = 0; i < trLanzamientos.length; i++) {
        if (disponible[i]) {
          trLanzamientos[i].classList.remove("filtro-lanzamientos");
        }else{
          trLanzamientos[i].classList.add("filtro-lanzamientos");
        }
      }
    }
  }

  function buscarDisponibilidad(obj){
    let plataformaFiltro;
    let plataformaObjeto;
    let disponible;
    let contPlataformas = 0;
    while (contPlataformas<4) {
      switch (contPlataformas) {
        case 0:
          plataformaFiltro = "PC";
        break;
        case 1:
          plataformaFiltro = "PS4";
        break;
        case 2:
          plataformaFiltro = "XBOX";
        break;
        case 3:
            plataformaFiltro = "SWITCH";
        break;
      }
      for (let contObjeto = 0; contObjeto < obj.length; contObjeto++) {
        plataformaObjeto = obj[contObjeto].thing.plataforma;
        let contLetrasPO = 0;
        disponible = false;
        while ((!disponible)&&(contLetrasPO <= (plataformaObjeto.length-plataformaFiltro.length))) {
          let contLetrasFiltro = 0;
          disponible = true;
          while ((contLetrasFiltro<plataformaFiltro.length)&&(disponible)) {
            let letra = plataformaObjeto[contLetrasPO+contLetrasFiltro].toUpperCase();
            if (letra!==plataformaFiltro[contLetrasFiltro]) {
              disponible = false;
            }
            contLetrasFiltro++;
          }
          contLetrasPO++;
        }
        switch (contPlataformas) {
          case 0:
            disponiblePC[contObjeto] = disponible;
          break;
          case 1:
            disponiblePS4[contObjeto] = disponible;
          break;
          case 2:
            disponibleXbox[contObjeto] = disponible;
          break;
          case 3:
            disponibleSwitch[contObjeto] = disponible;
          break;
        }
      }
      contPlataformas++;
    }
    console.log(disponiblePC);
    console.log(disponiblePS4);
    console.log(disponibleXbox);
    console.log(disponibleSwitch);
  }

});
