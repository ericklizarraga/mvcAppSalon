<h1 class="nombre-pagina">crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear cuenta</p>

<?php include_once __DIR__."/../templates/alertas.php";  ?>

<form action="/crear-cuenta" method="POST" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input value="<?php echo s($usuario->nombre) ?>" type="text" name="nombre" id="nombre" placeholder="tu nombre">
    </div>
   
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input  value="<?php echo s($usuario->apellido) ?>" type="text" name="apellido" id="apellido" placeholder="tu apellido">
    </div>
  
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input  value="<?php echo s($usuario->telefono) ?>" type="tel" name="telefono" id="telefono" placeholder="tu telefono">
    </div>

    <div class="campo">
        <label for="email">Email:</label>
        <input  value="<?php echo s($usuario->email) ?>" type="email" name="email" id="email" placeholder="tu email">
    </div>
   
    <div class="campo">
        <label for="password">Password:</label>
        <input  value="<?php echo s($usuario->password) ?>" type="password" name="password" id="password" placeholder="tu password">
    </div>

    <input type="submit" value="crear Cuenta" class="boton">
</form>


<div class="acciones">
    <a href="/">Ya tienes una cuenta inica Sesion</a>
    <a href="/olvide">olvidaste tu password ?</a>
</div>