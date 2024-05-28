<h1 class="nombre-pagina">
    Multas
</h1>

<p class="descripcion-pagina">
    Ingrese los datos para poder realizar la consulta de sus multas, ingrese la placa del vehiculo
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
        if(count($multas) === 0){
            echo "<h2>No hay multas registradas</h2>";
        }
    ?>

    <div id="multas-admin">
        <ul class="multas">
            <?php 
                foreach($multas as $multa){
            ?>
            <li>
                <p>ID: <span><?php echo $multa->id; ?></span></p>
                <p>Documento: <span><?php echo $multa->documento; ?></span></p>
                <p>Causa de la Multa: <span><?php echo $multa->descripcion; ?></span></p>
                <p>Fecha: <span><?php echo $multa->fecha; ?></span></p>
                <p>Identificación del agente: <span><?php echo $multa->idAgente; ?></span></p>
                <p>Direccion: <span><?php echo $multa->direccion; ?></span></p>
                <p>Placa del vehiculo: <span><?php echo $multa->placa; ?></span></p>

                <h3>Tipo de multa</h3>
                <p class="multa"><?php echo $multa->tipo .  " , donde su valor a pagar es de = COP " . $multa->precio; ?></p>
            </li>

            <?php
                }
            ?>
        </ul>
        
    </div>
</div>

<?php

    $script = "<script src='build/js/buscador.js'></script>"

?>