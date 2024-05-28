<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">

    <div class="campo">
        <label for="Email">Email</label>
        <input type="email" id="Email" placeholder="Tu Email" name="email"/>
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" 
            id="password" 
            placeholder="Tu password"
            name="password"
        />
    </div>

    <div class="centrar-boton">
        <input type="submit" value="Iniciar Sesión" class="boton">
    </div>

    
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes cuenta?, Crear una</a>
    <a href="/olvide">Olvidé mi contraseña</a>
</div>