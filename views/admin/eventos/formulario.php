<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion del Evento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formuario__label">Nombre del Evento</label>
        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre Evento" value="<?php echo $evento->nombre;?>"/>
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formuario__label">Descripcion del Evento</label>
        <textarea class="formulario__textarea" name="descripcion" id="descripcion" placeholder="Descripcion Evento" rows="8" ><?php echo $evento->descripcion;?></textarea>
    </div>
    <div class="formulario__campo">
        <label for="categoria" class="formuario__label">Tipo de Evento</label>
        <select  class="formulario__select" name="categoria_id" id="categoria" >
            <option  value=" ">--Seleccionar--</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected' : '';?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>

            <?php } ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formuario__label">Selecciona los dias</label>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) { ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                    <input type="radio" 
                            id="<?php echo strtolower($dia->nombre); ?>" 
                            name="dia" 
                            value="<?php echo $dia->id; ?>"
                            <?php echo ($evento->dia_id === $dia->id) ? 'checked' : ''; ?>
                            
                    />
                </div>

            <?php } ?>

           

        </div>

        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id?>">
       
    </div>

    

    <div id="horas" class="formulario__campo">
        <label class="formulario__label">Seleccione Hora</label>

        <ul class="horas">
            <?php foreach ($horas as $hora) { ?>
                <li data-hora-id= "<?php echo $hora->id; ?>"class="horas__hora horas__hora--deshabilitada" ><?php echo $hora->hora; ?></li>
            <?php } ?>

        </ul>

        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id ?>">


    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>
    <div class="formulario__campo">
        <label for="ponentes" class="formulario__label">Ponentes</label>
        <input type="text" id="ponentes" placeholder="Buscar Ponentes" class="formulario__input" />
        <ul id="listado-ponentes" class="listado-ponentes"></ul>
        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id;?>">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Plazas Disponibles</label>
        <input type="number" id="disponibles" placeholder="ej.20"  min="1" class="formulario__input" name="disponibles" value="<?php echo $evento->disponibles; ?>" />
    </div>












</fieldset>