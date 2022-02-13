<h1 class="nombre-pagina">login</h1>
<p class="descripcion-pagina">Iniciar sesion con tus datos</p>

<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" name="email" id="emial" placeholder="tu email">
    </div>
   
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="tu password">
    </div>

    <input class="boton" type="submit" value="iniciar sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear cuenta</a>
    <a href="/olvide">olvidaste tu password ?</a>
</div>