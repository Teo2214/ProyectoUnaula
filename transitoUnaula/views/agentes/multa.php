<h1 class="nombre-pagina">Multas agente</h1>
<p class="descripcion-pagina">Elige los servicios a utilizar</p>
<div class="barra">
    <p>Hola: <?php echo $nombre ?? '';?></p>
    <a class="boton" href="/logout">Cerrar sesion</a>
</div>

<div id="app" class="centrar-contenido">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Tipo Multas</button>
        <button type="button" data-paso="2">Realizar Multa</button>
        <button type="button" data-paso="3">Resumen Multa</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Tipo de Multa</h2>
        <p class="descripcion-pagina">Elige el tipo de multa a aplicar</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Realizar una multa</h2>
        <p class="descripcion-pagina">Ingresa los datos a quien pondrá la multa</p>

        <form class="formulario">
            <div class="campo campo-2">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" value="<?php echo $nombre ?>" disabled>
            </div>

            <div class="campo campo-2">
                <label for="documento">Documento del usuario</label>
                <input type="number" id="documento" placeholder="documento">
            </div>

            <div class="campo campo-2">
                <label for="descripcion">Descripcion de la multa</label>
                <textarea id="descripcion" placeholder="La descripcion debe ser muy corta, de lo contrario no sera tomada en cuenta" rows="10" cols="80"></textarea>
            </div>

            <div class="campo campo-2">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="campo campo-2">
                <label for="idAgente">ID del agente</label>
                <input type="number" id="idAgente" placeholder="Tu ID" value="<?php echo $idAgente ?>" disabled>
            </div>

            <div class="campo campo-2">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" placeholder="direccion">
            </div>

            <div class="campo campo-2"> 
                <label for="placa">Placa del vehiculo</label>
                <input type="text" id="placa" placeholder="placa">
            </div>
        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen multa</h2>
        <p class="descripcion-pagina">Verifique que todo este correcto</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">
            &laquo; Anterior
        </button>

        <button id="siguiente" class="boton">
            Siguiente &raquo; 
        </button>
    </div>
</div>

<?php
    $script="
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>    
    "
?>