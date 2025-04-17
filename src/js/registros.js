import Swal from 'sweetalert2'



(function() {
    let eventos = [];
    let resumen = document.querySelector('#registro-resumen')

    if(resumen){
        const eventosBoton =document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => boton.addEventListener('click', seleccionarEvento))
        
        const formularioRegistro = document.querySelector('#registro')
        formularioRegistro.addEventListener('submit', submitFormulario)

        mostrarEventos()

        function seleccionarEvento(e) {
            if(eventos.length < 5 ){
                //deshabilitar el evento una vez agregado
                e.target.disabled = true
                eventos = [...eventos, {
                    id : e.target.dataset.id,
                    titulo : e.target.parentElement.querySelector('.evento__nombre').textContent.trim()

                }]

                mostrarEventos()
            }else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Solo puedes añadir 5 eventos por registro',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        }

            

        function mostrarEventos(){
            //limpiar el html de eventos
            limpiarEventos();

            // iteramenos los eventos 
            if(eventos.length > 0 ){
                eventos.forEach(evento => {
                    
                    const eventoDOM = document.createElement('DIV')
                    eventoDOM.classList.add('registro__evento')

                    const titulo = document.createElement('H3')
                    titulo.classList.add('registro__nombre')
                    titulo.textContent= evento.titulo

                    const botonEliminar = document.createElement('BUTTON')
                    botonEliminar.classList.add('registro__eliminar')
                    botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`
                    botonEliminar.onclick = function() {
                        eliminarEvento(evento.id)
                    }


                    //renderizamos el resume en el html
                    eventoDOM.appendChild(titulo)
                    eventoDOM.appendChild(botonEliminar)
                    resumen.appendChild(eventoDOM)
                
                })
            } else {
                const noRegistro = document.createElement('P')
                noRegistro.textContent = 'No hay ningun registro, selecciona hasta 5 eventos'
                noRegistro.classList.add('registro__texto')
                resumen.appendChild(noRegistro)
            }
        }

        function limpiarEventos(){
            while(resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }

        function eliminarEvento(id){
            eventos = eventos.filter(evento => evento.id !== id)
            const botonAgregar = document.querySelector(`[data-id="${id}"]`)
            
            botonAgregar.disabled = false

            mostrarEventos();
            

        }
        async function submitFormulario(e){
            e.preventDefault();
            
            // validamos que haya un regalo seleccionado y evento
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map(evento => evento.id)

            // si no hay campos rellenos creamos una alerta
            if(eventosId.length === 0 || regaloId ===''){
                Swal.fire({
                    title: 'Error!',
                    text: 'Tienes que registrar al menos un evento y un regalo',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return
            }
            //objeto de formData
            const datos = new FormData();
            datos.append('eventos', eventosId)
            datos.append('regalo_id', regaloId)


            // si ya lo tenemos todo damos a resgistrar y creamos el metodo POST
            const url = '/finalizar-registro/conferencias'
            const respuesta = await fetch(url, {
                method :'POST',
                body : datos
            })
            
            const resultado = await respuesta.json();

            console.log(resultado);

            if(resultado.resultado){
                Swal.fire(
                    'Registro Exitoso',
                    'Tus eventos se ha guardado correctamente, te esperamos en DevWebCamp',
                    'success'
                ).then( () => location.href = `/entrada?id=${resultado.token}`)
                
            }else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Tus eventos no se han podido guardar, vuelve a intentarlo',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => location.reload())

            }
            
            

            

        }

    }

})();