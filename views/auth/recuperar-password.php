<h1 class="nombre-pagina">Recuperar password</h1>
<p class="descripcion-pagina"> coloca tu nuevo password a continuacion </p>


<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<?php
    if($error){
        return;
    }
?>
<form  class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="tu nuevo password">
    </div>
    <input class="boton" type="submit" value="Guarar Nuevo password">
</form>

<div class="acciones">
    <a href="/"> ya tiene  cuenta - iniciar sesion</a>
    <a href="/crear-cuenta">crear cuenta</a>
</div>