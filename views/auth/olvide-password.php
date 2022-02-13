<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">recupera tu cuenta</p>

<?php include_once __DIR__."/../templates/alertas.php";  ?>

<form action="" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" name="email" id="emial" placeholder="tu email">
    </div>

    <input class="boton" type="submit" value="iniciar sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear cuenta</a>
    <a href="/"> iniciar session </a>
</div>