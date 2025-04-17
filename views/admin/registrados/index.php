<h2 class="dashboard__heading"><?php echo $titulo;?></h2>
<div class="dashboard__contenedor">
    <?php if(!empty($registros)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" scope="col">Nombre</th>
                    <th class="table__th" scope="col">Email</th>
                    <th class="table__th" scope="col">Plan</th>

                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach($registros as $registro) { ?>
                    <tr class="table__tr">
                    <td class="table__td">
                            <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido;?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro->usuario->email;?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro->paquete->nombre;?>
                        </td>
                    
                        

                    </tr>
                <?php }?>        
            </tbody>

        </table>


    <?php } else {?>
        <p class="text-center">No Hay Ningun Registrado</p>
    <?php }?>
   <?php 
        echo $paginacion;
   ?> 

</div>