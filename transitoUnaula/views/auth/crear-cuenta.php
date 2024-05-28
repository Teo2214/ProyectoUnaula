<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el formulario para crear tu cuenta</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>
<form action="/crear-cuenta" method="POST" class="formulario">

    <div class="campo">
        <label for="documento">Documento</label>
        <input type="number" id="documento" name="id" placeholder="Tu documento" value="<?php  echo s($usuario->idUsuario); ?>">
    </div>

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php  echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellidos" placeholder="Tu apellido" value="<?php  echo s($usuario->apellidos); ?>">
    </div>

    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input type="tel" id="Telefono" name="telefono" placeholder="Tu Telefono" value="<?php  echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="Email">Email</label>
        <input type="email" id="Email" name="email" placeholder="Tu Email" value="<?php  echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu password" >
    </div>


    <div class="centrar-boton">
        <input type="submit" value="Crear Cuenta" class="boton">
    </div>
    
</form>

<div class="acciones">
    <a href="/">Iniciar Sesión</a>
    <a href="/olvide">Olvidé mi contraseña</a>
</div>