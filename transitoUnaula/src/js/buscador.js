document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    buscarPlaca();
}

function buscarPlaca(){
    const placaInput = document.querySelector('#placa');
    placaInput.addEventListener('input', function(e){
        const placaSeleccionada = e.target.value;

        const longitudEsperada = 6;

        if(placaSeleccionada.length === longitudEsperada){
            window.location = `?placa=${placaSeleccionada}`;
        }

        
    });
}
