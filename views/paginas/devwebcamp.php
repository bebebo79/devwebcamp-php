<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo;?></h2>
    <p class="devwebcamp__descripcion">Conoce la conferencia más importante en España</p>
    <div class="devwebcamp__grid">
        <div <?php echo aos_animacion();?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img src="build/img/sobre:devwebcamp.jpg" loading="lazy" width="200" height="300" alt="Imagen DevWebCamp"> 

            </picture>

        </div>
        <div class="devwebcamp__contenido">
            <p <?php echo aos_animacion();?> class="devwebcamp__texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eros lorem, vulputate vitae varius non, ornare in nisi. Maecenas sed tempor turpis. Sed non ultrices lectus. Fusce porttitor congue neque, non ornare libero luctus quis. Fusce urna mi, iaculis a volutpat vel, aliquam eu felis. Nunc ac nisl nisi. Aliquam urna enim, hendrerit vel libero vel, dictum placerat risus.</p>
            <p class="devwebcamp__texto">Proin commodo orci nec efficitur hendrerit. Nam fermentum est sit amet faucibus gravida. Quisque porta mauris in tortor rutrum maximus. Nunc suscipit leo congue augue consectetur molestie. Quisque et urna blandit, cursus nisi hendrerit, blandit nulla. Donec non vehicula dolor. Sed volutpat felis in pellentesque mollis. </p>
        </div>
        
    
    </div>





</main>