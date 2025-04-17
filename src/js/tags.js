(function (){
    const tagsInput = document.querySelector('#tags_input');
    if(tagsInput){
        const tagsDev = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');
        let tags = [];

        // recuperar lo oculto ( hidden ), lo pasamos a un array y lo mostramos con la funcion 
        if(tagsInputHidden.value !== ''){
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }


        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e){
            if(e.keyCode === 44){
                //prevenir que una vez dada la coma luego vuelva a defautl
                e.preventDefault();

                // para que nadie ponga un string vacio o un campo con un caracter
                if(e.target.value.trim() === '' || e.target.value < 1){
                    return
                }

                //añadimos al array el valor dado
                tags = [...tags, e.target.value.trim()]
                
                //borramos el imput
                tagsInput.value = '';

                mostrarTags();

            }

        }
        function mostrarTags(){
            tagsDev.textContent = '';
            
            tags.forEach(tag=>{
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tags');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTags;
                tagsDev.appendChild(etiqueta);
               
            });

            actualizarInputHidden();
        }


        function actualizarInputHidden(){
            tagsInputHidden.value = tags.toString();

        }
        function eliminarTags(e){
            e.target.remove();
            // para eliminarlo del array se hace con un filter
            tags = tags.filter(tag => tag != e.target.textContent)
            // para eliminarlo del value
            actualizarInputHidden();

        }
    }


})();