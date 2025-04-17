(function(){
    const ponentesInput = document.querySelector('#ponentes');
    if(ponentesInput){
        let ponentes = [];
        let ponentesFiltrados = [];

        const ponenteInputHidden = document.querySelector('[name="ponente_id"]')

        const listadoPonentes = document.querySelector('#listado-ponentes');

        obtenerPonentes()

        ponentesInput.addEventListener('input', buscarPonente);

        if(ponenteInputHidden.value){
            (async() => {
              const ponente = await obtenerPonente(ponenteInputHidden.value);  
              const {nombre, apellido} = ponente 
              
              //creamos el HTML
              const ponenteDOM = document.createElement('LI');
              ponenteDOM.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--seleccionado');
              ponenteDOM.textContent = `${nombre} ${apellido}`;

              // inyectamos el html
              listadoPonentes.appendChild(ponenteDOM);
                
            })();
            
        }    
        async function obtenerPonentes(){
            const url = `/api/ponentes`
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);
        }

        async function obtenerPonente(id){
            const url = `/api/ponente?id=${id}`
            const respuesta =  await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        
        
        }

        function formatearPonentes(ponentesArray=[]){
            ponentes = ponentesArray.map(ponente =>{
                return{
                    nombre:`${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
           
        }

        function buscarPonente(e){
            const busqueda = e.target.value;
            if(busqueda.length >3){
                const expresion = new RegExp(busqueda, "i")
                ponentesFiltrados = ponentes.filter(ponente => {
                    if(ponente.nombre.toLowerCase().search(expresion) != -1 ){
                        return ponente
                    }
                })
                
            }else {
                ponentesFiltrados = [];
            }
            mostrarPonentes()
        }
        function mostrarPonentes(){
            //para borrar las busquedas,vamos elimiando el primer hijo
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild)
            }
            
            //iteramos en los ponentes de la base de datos, creando una lista
            if(ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente')
                    ponenteHTML.textContent = ponente.nombre
                    ponenteHTML.dataset.ponenteId = ponente.id
                    ponenteHTML.onclick = seleccionarPonente
    
                    //añadir al Dom
                    listadoPonentes.appendChild(ponenteHTML);
                })

            } else {
                const noResultado = document.createElement('P');
                noResultado.classList.add('listado-ponentes__no-resultado');
                noResultado.textContent =  'No hay resultado para tu busqueda';
                
                //añadimos al Dom
                listadoPonentes.appendChild(noResultado);
            }
        }
        function seleccionarPonente(e){
            // remover en el caso de seleccion previo
            const seleccionPrevia = document.querySelector('.listado-ponentes__ponente--seleccionado');
            if(seleccionPrevia){
                seleccionPrevia.classList.remove('listado-ponentes__ponente--seleccionado');
            }

            const ponente = e.target
            ponente.classList.add('listado-ponentes__ponente--seleccionado')

            ponenteInputHidden.value = ponente.dataset.ponenteId

        }
    }














})();