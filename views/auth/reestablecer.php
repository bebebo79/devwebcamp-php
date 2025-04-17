<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Pon tu nuevo Password</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($token_valido){ ?>
    <form class="formulario" method="POST">
    <div class="formulario__campo">
           
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Nuevo Password</label>
            <input 
                class="formulario__input"
                type="password"
                id="password"
                name="password"
                placeholder="Tu Nuevo Password"
                
            
            />
        </div>
        

        <input type="submit" class="formulario__submit" value="Guardar Password">

    </form>
    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta?<br>Inicia Sesion</br></a>
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta?<br>Crear una cuenta</br></a>
    </div>

        
</main>