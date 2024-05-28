<h1 class="nombre-pagina">Olvidé mi contraseña</h1>
<p class="descripcion-pagina">Reestablece tu contraseña ingresando tu email a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/olvide" class="formulario" method="POST">

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Email">

    </div>

    <div class="centrar-boton">
        <input type="submit" value="Enviar Instrucciones" class="boton">
    </div>
    
</form>

<div class="acciones">
    <a href="/">Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta?, Crear una</a>
</div>