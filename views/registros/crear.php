<main class="registros">
    <h2 class="registros__heading"><?php echo $titulo;?></h2>
    <p class="registros__descripcion">Elige el Plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__listado">
                <li class="paquete_elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">0.00 €</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input type="submit" class="paquete__submit" value="Inscripcion Gratuita">
            </form>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__listado">
                <li class="paquete_elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete_elemento">Pase de dos días</li>
                <li class="paquete_elemento">Acceso a Talleres y conferencias</li>
                <li class="paquete_elemento">Acceso a las Grabaciones</li>
                <li class="paquete_elemento">Camisa del Evento</li>
                <li class="paquete_elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">199.00 €</p>
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container"></div>
              </div>
            </div>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__listado">
                <li class="paquete_elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete_elemento">Pase de dos días</li>
                <li class="paquete_elemento">Enlace a Talleres y Conferencias</li>
                <li class="paquete_elemento">Acceso a las Grabaciones</li>

            </ul>
            <p class="paquete__precio">49.00 €</p>
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container--virtual"></div>
              </div>
            </div>
        </div>





    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AXuKWAx4duQBfLxMbMmIyVdQbp81j3fYsccDW4xtdJm5-G_LvbEtikKkbW9lPWqikQFA8k1YpAFms9tL&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
 
<script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"EUR","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const datos = new FormData();

            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar', {
              method: 'POST',
              body: datos
            })
            .then( respuesta=> respuesta.json())
            .then(resultado => {
              if(resultado.resultado){
                const url = window.location.origin + '/finalizar-registro/conferencias'
                actions.redirect(url)
              }
            })
          });
        }, 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    
      // boton virtual
    
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"EUR","value":49}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const datos = new FormData();

            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar', {
              method: 'POST',
              body: datos
            })
            .then( respuesta=> respuesta.json())
            .then(resultado => {
              if(resultado.resultado){
                const url = window.location.origin + '/finalizar-registro/conferencias'
                actions.redirect(url)
              }
            })
          });
        }, 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container--virtual');
    

    }
 
    initPayPalButton();
</script>