<h1 class="nombre-pagina">-Nuevo Servicios</h1>
<p class="descripcion-pagina">Creacion  de Servicios</p>

<?php include_once __DIR__.'/../templates/barra.php'; ?>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<form action="/servicios/crear" method="POST" class="formulario">

        <?php include_once __DIR__.'/formulario.php'; ?>

    <input class="boton" type="submit" value="guadar Servicio">
</form>