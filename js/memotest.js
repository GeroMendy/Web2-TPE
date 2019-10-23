function ejecutarJSMemotest() {

  "use strict";
  console.log("game-working");

  const TIME = 800;
  const CANT_CARTAS = 5;

  <!-- variables para destacarHoverBotonComenzar() -->
  let imagenBotonComenzarMemotest = document.getElementById('imagenBotonComenzarMemotest');
  let botonComenzarHover = false;

  <!-- variables para esconder/mostrar botones -->
  let divComenzar = document.getElementsByClassName('botonComenzar');
  divComenzar = divComenzar[0];
  let ingresarPosicionCarta = document.getElementsByClassName('ingresarPosicionCarta');
  ingresarPosicionCarta = ingresarPosicionCarta[0];

  <!-- variables para tabla-->
  let tablaBodyResultados = document.getElementById('tablaBodyResultados');
  let arrCeldasFootTabla = document.getElementsByClassName('resultadoTotal');
  let tablaAciertos,tablaErrores,tablaBombas,tablaPartidas = 0;
  let tablaBombasTotal = 0, tablaAciertosTotal = 0, tablaErroresTotal = 0,tablaPartidasTotal = 0;

  <!-- variables para el juego en general -->
  let arrCartas = document.getElementsByClassName('carta');
  let numeroCarta = new Array();
  let cartasGuardadas = new Array();
  let victoria = false;
  let probabilidad, valorSelector, cantidadX;


  ingresarPosicionCarta.classList.add("hidden");//Para que se inicialize oculto.

  function destacarHoverBotonComenzar(imagenBotonComenzarHover){
    if (imagenBotonComenzarHover) {
      imagenBotonComenzarMemotest.src = "../img/memotest/jugar_hover.svg";
    }
    else {
      imagenBotonComenzarMemotest.src = "../img/memotest/jugar.svg";
    }
  }

  function llenar(){
    tablaAciertos = 0;
    tablaErrores = 0;
    tablaBombas = 0;
    divComenzar.classList.add("hidden");
    ingresarPosicionCarta.classList.remove("hidden");
    tablaPartidas++;
    cantidadX = 0;
    for (let contadorLlenar = 0; contadorLlenar < arrCartas.length; contadorLlenar++) {
      probabilidad = Math.random();
      if (probabilidad<0.5) {
        arrCartas[contadorLlenar].src = "../img/memotest/acierto.png";
        cantidadX--;
        numeroCarta[contadorLlenar] = 1;
      }
      else if (probabilidad<0.9) {
        arrCartas[contadorLlenar].src = "../img/memotest/error.png";
        numeroCarta[contadorLlenar] = 0;
      }
      else {
        arrCartas[contadorLlenar].src = "../img/memotest/bomba.png";
        numeroCarta[contadorLlenar] = 2;
      }
      cartasGuardadas[contadorLlenar] = arrCartas[contadorLlenar].src;
    }
    if (cantidadX === 0) {
      terminarPartida(true);
    }
    else {
      setTimeout(function () {
        for (let contadorTapar = 0; contadorTapar < arrCartas.length; contadorTapar++) {
          arrCartas[contadorTapar].src = "../img/memotest/tapa.png";
        }
      },TIME);
    }
  }

  function terminarPartida(victoria){
    console.log(typeof tablaPartidas);
    console.log(typeof tablaPartidasTotal);
    tablaPartidasTotal = tablaPartidas;
    tablaAciertosTotal += tablaAciertos;
    tablaErroresTotal += tablaErrores;
    tablaBombasTotal += tablaBombas;
    ingresarPosicionCarta.classList.add("hidden");
    divComenzar.classList.remove("hidden");
    if (victoria) {
      console.log("VICTORIA");
    }
    else {
      console.log("DERROTA");
    }
    crearFilaTabla();
    voltearCartas();
  }

  function jugar(){
    valorSelector = document.getElementById('selector').value;
    document.getElementById('selector').value = null;
    if ((valorSelector>0)&&(valorSelector<=arrCartas.length)) {
      console.log("valor ingresado valido");
      valorSelector--; //Para que funcione como arreglo.//
      switch (numeroCarta[valorSelector]) {
        case 1:
        cantidadX++;
        arrCartas[valorSelector].src = cartasGuardadas[valorSelector];
        tablaAciertos++;
        numeroCarta[valorSelector] = 3;
        break;
        case 0:
        arrCartas[valorSelector].src = cartasGuardadas[valorSelector];
        tablaErrores++;
        numeroCarta[valorSelector] = 3;
        break;
        case 2:
        cantidadX = 1;
        arrCartas[valorSelector].src = cartasGuardadas[valorSelector];
        tablaBombas++;
        numeroCarta[valorSelector] = 3;
        terminarPartida(false);
        default:
        console.log("Repite valor");
      }
    }
    else {
      console.log("Valor ingresado no valido");
    }
    if (cantidadX === 0) {
      terminarPartida(true);
    }
  }

  function crearFilaTabla(){
    let fila = document.createElement("tr");
    let celdaPartidas = document.createElement("td");
    let celdaAciertos = document.createElement("td");
    let celdaErrores = document.createElement("td");
    let celdaBombas = document.createElement("td");
    let valorCeldaPartidas = document.createTextNode(tablaPartidas);
    let valorCeldaAciertos = document.createTextNode(tablaAciertos);
    let valorCeldaErrores = document.createTextNode(tablaErrores);
    let valorCeldaBombas = document.createTextNode(tablaBombas);
    let arrResultadosTotales = [tablaPartidasTotal, tablaAciertosTotal, tablaErroresTotal, tablaBombasTotal];

    celdaPartidas.appendChild(valorCeldaPartidas);
    celdaAciertos.appendChild(valorCeldaAciertos);
    celdaErrores.appendChild(valorCeldaErrores);
    celdaBombas.appendChild(valorCeldaBombas);
    fila.appendChild(celdaPartidas);
    fila.appendChild(celdaAciertos);
    fila.appendChild(celdaErrores);
    fila.appendChild(celdaBombas);
    console.log(fila);
    tablaBodyResultados.appendChild(fila);

    for (let contadorResultadosTotales = 0; contadorResultadosTotales < arrCeldasFootTabla.length; contadorResultadosTotales++) {
      arrCeldasFootTabla[contadorResultadosTotales].innerHTML = arrResultadosTotales[contadorResultadosTotales];
    }
  }

  function enviarConTeclaEnter(event){
    let teclaPresionada = (event.which || event.keyDown);
    if (teclaPresionada === 13) {
      console.log(teclaPresionada);
      jugar();
    }
  }

  function voltearCartas(){
    for (let contadorVoltear = 0; contadorVoltear < arrCartas.length; contadorVoltear++) {
      arrCartas[contadorVoltear].src = cartasGuardadas[contadorVoltear];
    }
  }

  <!-- Variables para eventListener -->
  let botonComenzarMemotest = document.getElementById('botonComenzarMemotest');
  let botonEnviarSeleccionMemotest = document.getElementById('botonEnviarSeleccionMemotest');
  //variable selector ya declarada.

  <!-- eventListener -->
  botonComenzarMemotest.addEventListener("click", llenar);
  botonComenzarMemotest.addEventListener("mouseover", function(){destacarHoverBotonComenzar(true)});
  botonComenzarMemotest.addEventListener("mouseout", function(){destacarHoverBotonComenzar(false)});
  selector.addEventListener("keydown", function(){enviarConTeclaEnter(event)});
  botonEnviarSeleccionMemotest.addEventListener("click", jugar);

}
