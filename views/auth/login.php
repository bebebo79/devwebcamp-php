<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Inicia Sesion en DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php';?>

    <form class="formulario" method="POST" action="/login">
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
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                class="formulario__input"
                type="password"
                id="password"
                name="password"
                placeholder="Tu Password"
                
            
            />
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar Sesion">

    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta? <br>Crear una cuenta</br></a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste el Password?<br>Reestablece tu Password</br></a>




    </div>


</main>