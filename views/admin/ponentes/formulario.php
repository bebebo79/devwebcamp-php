<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <label for="nombre" class="formuario__label">Nombre</label>
        <input  type="text"
                class="formulario__input"
                name="nombre"
                id="nombre"
                placeholder="Nombre Ponente"
                value="<?php echo $ponente->nombre ?? '';?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="apellido" class="formuario__label">Apellido</label>
        <input  type="text"
                class="formulario__input"
                name="apellido"
                id="apellido"
                placeholder="Apellido Ponente"
                value="<?php echo $ponente->apellido ?? '';?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="ciudad" class="formuario__label">Ciudad</label>
        <input  type="text"
                class="formulario__input"
                name="ciudad"
                id="ciudad"
                placeholder="Ciudad Ponente"
                value="<?php echo $ponente->ciudad ?? '';?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="pais" class="formuario__label">Pais</label>
        <input  type="text"
                class="formulario__input"
                name="pais"
                id="pais"
                placeholder="Pais Ponente"
                value="<?php echo $ponente->pais ?? '';?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="imagen" class="formuario__label">Imagen</label>
        <input  type="file"
                class="formulario__input formulario__input--file"
                name="imagen"
                id="imagen"
               
        />

        
    </div>
    <?php if(isset($ponente->imagen_actual)){ ?>
        <p class="formulario__texto">Imagen Actual: </p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'. $ponente->imagen;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'. $ponente->imagen;?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/'. $ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>

        </div>



    <?php }?>    
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Inforacion Adicional</legend>
    
    <div class="formulario__campo">
        <label for="tags-input" class="formuario__label">Áreas de Experiencia (separadas por comas )</label>
        <input  type="text"
                class="formulario__input"
                id="tags_input"
                placeholder="Ej. Node.JS, PHP, CSS, Laravel, UX/UI"
                
        />
        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ??''; ?>">
    </div>

</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[facebook]"
                placeholder="Facebook"
                value="<?php echo $redes->facebook ?? '';?>"
        />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[twitter]"
                placeholder="Twitter"
                value="<?php echo $redes->twitter ?? '';?>"
        />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[youtube]"
                placeholder="YouTube"
                value="<?php echo $redes->youtube ?? '';?>"
        />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[instagram]"
                placeholder="Instagram"
                value="<?php echo $redes->instagram ?? '';?>"
        />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[tiktok]"
                placeholder="TikTok"
                value="<?php echo $redes->tiktok ?? '';?>"
        />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
        <input  type="text"
                class="formulario__input--sociales"
                name="redes[github]"
                placeholder="GitHub"
                value="<?php echo $redes->github ?? '';?>"
        />
        </div>
    </div>
    



</fieldset>