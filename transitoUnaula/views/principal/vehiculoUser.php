<h1 class="nombre-pagina">
    Vehiculos
</h1>

<p class="descripcion-pagina">
    Ingrese los datos para poder realizar la consulta de su vehiculo, ingrese la placa del vehiculo
</p>

<div class="busqueda">
    <form class="formulario">
        <div class="consultaVehiculo">
            <div class="campo">
                <label for="placa">Ingrese la placa</label>
                <input type="text" id="placa" name="placa" placeholder="Placa del vehiculo">
            </div>
        </div>
        
    </form>

    <?php
        if(count($vehiculos) === 0){
            echo "<h2>No hay vehiculos registrados</h2>";
        }
    ?>

    <div id="multas-admin">
        <ul class="multas">
            <?php 
                foreach($vehiculos as $vehiculo){
            ?>
            <li>
                <p>Placa: <span><?php echo $vehiculo->placa; ?></span></p>
                <p>Marca: <span><?php echo $vehiculo->marca; ?></span></p>
                <p>Modelo: <span><?php echo $vehiculo->modelo; ?></span></p>
                <p>Pais: <span><?php echo $vehiculo->pais; ?></span></p>
                <p>Documento del propietario: <span><?php echo $vehiculo->documentoPropietario; ?></span></p>
                <p>cilindraje: <span><?php echo $vehiculo->cilindraje; ?></span></p>
                <p>Tipo vehicular: <span><?php echo $vehiculo->idTipoVehiculo; ?></span></p>
                <p>Tipo de servicio: <span><?php echo $vehiculo->tipoServicio; ?></span></p>
                <p>Color: <span><?php echo $vehiculo->color; ?></span></p>
                <p>Numero de multas: <span><?php echo $vehiculo->numeroMultas; ?></span></p>


            <?php
                }
            ?>
        </ul>
        
    </div>
</div>

<?php

    $script = "<script src='build/js/buscador.js'></script>"

?>