<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?> </p>
    <a class="boton" href="/logout">Cerrar Sesion</a>
</div>


<?php if(isset($_SESSION['admin'])) : ?>
            <div class="barra-servicios">
                    <a href="/admin" class="boton"> Ver cita</a>
                    <a href="/servicios" class="boton">ver servicios</a>
                    <a href="/servicios/crear" class="boton">nuevo servicio</a>
            </div>
<?php endif;?>