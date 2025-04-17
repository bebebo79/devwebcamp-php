<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Crear Cuenta en DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php';?>

    <form class="formulario" method="POST" action="/registro">
    <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                class="formulario__input"
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu Nombre"
                value="<?php echo $usuario->nombre;?>"
                
            
            />
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                class="formulario__input"
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu Apellido"
                value="<?php echo $usuario->apellido?>"
                
            
            />
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                class="formulario__input"
                type="email"
                id="email"
                name="email"
                placeholder="Tu Email"
                value="<?php echo $usuario->email; ?>"
                
            
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
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Confirmar Password</label>
            <input 
                class="formulario__input"
                type="password"
                id="password2"
                name="password2"
                placeholder="Repite el Password"
                
            
            />
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta?<br>Inicia Sesion</br></a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste el Password?<br>Reestablece tu Password</br></a>
    </div>


</main>