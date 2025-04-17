<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Reestablece tu acceso a DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/olvide">
    <div class="formulario__campo">
           
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                class="formulario__input"
                type="email"
                id="email"
                name="email"
                placeholder="Tu Email"
                
            
            />
        </div>
        

        <input type="submit" class="formulario__submit" value="Enviar Solicitud ">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta?<br>Inicia Sesion</br></a>
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta?<br>Crear una cuenta</br></a>
    </div>


</main>