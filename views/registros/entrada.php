<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo;?></h2>
    <p class="pagina__descripcion">Aquí tienes tu entrada, guardarla y comparte en redes sociales</p>

    <div class="entrada-virtual">

        <div class="entrada entrada--<?php echo strtolower($registro->paquete->nombre);?> entrada--acceso" >
            <div class="entrada__contenido">    
                <h4 class="entrada__logo"> &#60;DevWebCamp /></h4>
                <p class="entrada__tipo"><?php echo $registro->paquete->nombre; ?></p>
                <p class="entrada__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?></p>
            </div>

            <p class="entrada__codigo">#<?php echo $registro->token;?></p>


        </div>






    </div>



</main>

