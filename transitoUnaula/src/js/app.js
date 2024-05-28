let paso=1;
const pasoInicial=1;
const pasoFinal=3;

const comparendo = {
    documento: '',
    descripcion: '',
    fecha: '',
    idAgente: '',
    direccion: '',
    placa: '',
    multas: []
}

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); //muestra la primera seccion
    tabs(); //cambia la sesion cuando se cambian los tabs
    botonesPaginador();//agregar o quitar los botones del paginador
    paginaAnterior();
    paginaSiguiente();

    consultarAPI(); //consulta la API en el backend

    idDelAgente();//añade el idAgente

    seleccionarFecha();//añade la fecha en un objeto
    seleccionarDocumento();
    seleccionarDescripcion();
    seleccionarDireccion();
    seleccionarPlaca();

    mostrarResumen();//muestra el resumen de la multa
    
}

function mostrarSeccion(){
    // ocultar la seccion que tenga la clase de mostrar

    const seeccionAnterior=document.querySelector('.mostrar');
    if(seeccionAnterior){
        seeccionAnterior.classList.remove('mostrar');
    }
    

    //Seleccionar seccion con el paso...
    const pasoSelect=`#paso-${paso}`;
    const seccion = document.querySelector(pasoSelect);
    seccion.classList.add('mostrar');

    //quitar la clase de actual al tab
    const tabAnterior=document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    // resalta el tab actual
    const tab=document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton =>{
        boton.addEventListener('click', function(e){
            
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();
            botonesPaginador();

        })
    });
}

function botonesPaginador(){
    const paginaSiguiente=document.querySelector('#siguiente');
    const paginaAnterior=document.querySelector('#anterior');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso===3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        mostrarResumen();
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior=document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso<=pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

function paginaSiguiente(){
    const paginaSiguiente=document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso>=pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

async function consultarAPI(){

    try {
        const url='http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error)
    }
}

function mostrarServicios(multas){
    multas.forEach(multa=>{
        const {idTipoMulta, tipo, descripcion, precio} = multa;
        
        const tipoMulta = document.createElement('P');
        tipoMulta.classList.add('nombre-multa');
        tipoMulta.textContent=tipo;

        const precioMulta = document.createElement('P');
        precioMulta.classList.add('precio-multa');
        precioMulta.textContent=`$${precio}`;

        const multaDiv=document.createElement('DIV');
        multaDiv.classList.add('tipoMultas');
        multaDiv.dataset.idTipos = idTipoMulta;
        multaDiv.onclick = function(){
            seleccionarMulta(multa)
        };

        multaDiv.appendChild(tipoMulta);
        multaDiv.appendChild(precioMulta);

        document.querySelector('#servicios').appendChild(multaDiv);
    });
}

function seleccionarMulta(multa){
    const {idTipoMulta} = multa;
    const {multas}=comparendo;
    //identificar elemento 
    const divMulta = document.querySelector(`[data-id-tipos="${idTipoMulta}"]`);

    //comprobar si un servicio esta seleccionado o quitar
    if(multas.some(agregado => agregado.idTipoMulta === idTipoMulta)){
        //eliminarlo
        comparendo.multas=multas.filter(agregado => agregado.idTipoMulta !== idTipoMulta);
        divMulta.classList.remove('seleccionado');
    }else{
        //agregarlo
        comparendo.multas=[...multas, multa];
        divMulta.classList.add('seleccionado');
    }

    

    
    

    console.log(comparendo);
}

function idDelAgente(){
    comparendo.idAgente = document.querySelector('#idAgente').value;

    
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(){
        comparendo.fecha=inputFecha.value;
    });
}

function seleccionarDocumento(){
    const inputDocumento = document.querySelector('#documento');
    inputDocumento.addEventListener('input', function(){
        comparendo.documento = inputDocumento.value
    });
}

function seleccionarDescripcion(){
    const inputDescripcion = document.querySelector('#descripcion');
    inputDescripcion.addEventListener('input', function(){
        comparendo.descripcion = inputDescripcion.value
    });
}

function seleccionarDireccion(){
    const inputDireccion = document.querySelector('#direccion');
    inputDireccion.addEventListener('input', function(){
        comparendo.direccion = inputDireccion.value
    });
}

function seleccionarPlaca(){
    const inputPlaca = document.querySelector('#placa');
    inputPlaca.addEventListener('input', function(){
        comparendo.placa = inputPlaca.value
    });
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    //limpiar contenido del resumen

    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    

    if(Object.values(comparendo).includes('') || comparendo.multas.length===0){
        mostrarAlerta('Faltana datos', 'error', '.contenido-resumen', false)

        return;
    }

    //formatear el div de resumen
    const {documento, descripcion, fecha, idAgente, direccion, placa, multas} = comparendo;

    const documentoUser = document.createElement('P');
    documentoUser.innerHTML = `<span>Documento: </span> ${documento}`;

    const descripcionMulta = document.createElement('P');
    descripcionMulta.innerHTML = `<span>Descripcion: </span> ${descripcion}`;

    //formatear la fecha
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const day = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, day));

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    const fechaFormateada = fechaUTC.toLocaleDateString('es-CO', opciones);


    const fechaMulta = document.createElement('P');
    fechaMulta.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;

    const idAgenteUser = document.createElement('P');
    idAgenteUser.innerHTML = `<span>Documento Agente: </span> ${idAgente}`;

    const direccionMulta = document.createElement('P');
    direccionMulta.innerHTML = `<span>Direccion: </span> ${direccion}`;

    const placaMulta = document.createElement('P');
    placaMulta.innerHTML = `<span>Placa: </span> ${placa}`;

    //heading para servicios
    const headdingMultas = document.createElement('H3');
    headdingMultas.textContent='Resumen de la multa';
    resumen.appendChild(headdingMultas);

    multas.forEach(multa=>{
        const {tipo, precio} = multa;
        const contenedorMulta = document.createElement('DIV');
        contenedorMulta.classList.add('contenedor-multa');

        const textoMulta =  document.createElement('P');
        textoMulta.textContent = tipo;

        const precioMulta = document.createElement('P');
        precioMulta.innerHTML = `<span>Precio: </span> $${precio}`;

        contenedorMulta.appendChild(textoMulta);
        contenedorMulta.appendChild(precioMulta);

        resumen.appendChild(contenedorMulta);
    })

    resumen.appendChild(documentoUser);
    resumen.appendChild(descripcionMulta);
    resumen.appendChild(fechaMulta);
    resumen.appendChild(idAgenteUser);
    resumen.appendChild(direccionMulta);
    resumen.appendChild(placaMulta);
    

    //boton para crear cita
    const botonRealizar = document.createElement('BUTTON');
    botonRealizar.classList.add('boton');
    botonRealizar.textContent='Realizar multa';
    botonRealizar.onclick = realizarMulta;

    resumen.appendChild(botonRealizar);
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    const alerta = document.createElement('DIV');
    alerta.textContent=mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece){
        setTimeout(()=>{
            alerta.remove();
        }, 3000)
    }
    
}

async function realizarMulta(){
    //form data es el metodo de recoleccion de los datos, es como el submit de javascript
    const {documento, descripcion, fecha, idAgente, direccion, placa, multas} = comparendo;
    const idTipodeMulta = multas.map(multa => multa.idTipoMulta);
    
    const datos = new FormData();
    //append es el envio de los datos
    datos.append('documento', documento);
    datos.append('descripcion', descripcion);
    datos.append('fecha', fecha);
    datos.append('idAgente', idAgente);
    datos.append('direccion', direccion);
    datos.append('placa', placa);
    datos.append('idTipoMulta', idTipodeMulta);

    //PETICION HACIA LA API
    try {
        const url = 'http://localhost:3000/api/multa';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
    
        const resultado = await respuesta.json();
        console.log(resultado.resultado);
    
        if(resultado.resultado){
            Swal.fire({
                title: "Multa Registrada",
                text: "Tu multa fue registrada con exito",
                icon: "success"
              }).then(()=>{
                window.location.reload();
              })
        }
        
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "ocurrio un error al guardar multa, verifique no haber puesto mas de un tipo de multa al usuario"
          });
    }
   
}
