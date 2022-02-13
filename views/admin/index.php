<h1 class="nombre-pagina">panel de Administracion</h1>

<?php

use Model\Cita;

include_once __DIR__.'/../templates/barra.php';  ?>

<h2>Buscar citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha ?? ''; ?>" >
        </div>
    </form>
</div>

<?php
    if(count($citas)===0){
        echo "<h2>no hay citas en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
            $idcita = ''; 
            foreach( $citas as $key => $cita) :   
                if($idcita !== $cita->id) :
                    $idcita = $cita->id;
                    $total = 0;
        ?>
            <li>
                    <p>ID : <span><?php echo $cita->id; ?></span> </p>
                    <p>cliente : <span><?php echo $cita->cliente; ?></span> </p>
                    <p>hora : <span><?php echo $cita->hora; ?></span> </p>
                    <p>telefono : <span><?php echo $cita->telefono; ?></span> </p>
                    <p>precio : <span><?php echo $cita->precio; ?></span> </p>
                    
                    <h1>Servicios</h1>
         <?php endif; ?>
                    <p class="servicio">servicio : <span><?php echo $cita->servicio."  $".$cita->precio; ?></span> </p>

                    <?php
                        $total += $cita->precio;
                        $actual = $cita->id;
                        $proximo = $citas[$key + 1]->id ?? 0;
                      
                        if( esUltimo($actual, $proximo) ) :
                    ?>
                            <p class="total">Total:<span>$ <?php echo $total ; ?></span> </p>
                            <form action="/api/eliminar" method="POST">
                                <input
                                    type="hidden" 
                                    name="id" 
                                    value="<?php echo $cita->id; ?>"
                                 >
                                 <input
                                    type="submit"
                                    class="boton-eliminar"
                                    value="Eliminar"
                                 >
                            </form>
                    <?php endif; ?>
            </li>
        <?php endforeach ; ?>
    </ul>
</div>

<?php $script = "<script src='build/js/buscador.js'></script>"; ?>