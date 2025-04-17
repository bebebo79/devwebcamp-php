<?php
namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as image;



class PonentesController {

    public static function index (Router $router){

        if(!is_admin()){
            header ('Location:/login');
        }
        //PAGINA ACTUAL ///
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1){
            header('Location:/admin/ponentes?page=1');
        }

        // REGISTRO POR PAGINA, LO INDICAMOS NOSOTROS ///
        $registros_por_pagina = 10;

        //REGISTROS TOTALES /// FUNCION ACTIVE RECORD
        $registros_totales= Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/ponentes?page=1');
        }
       
        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());
        
        $router->render('admin/ponentes/index', [
            'titulo'=>'Ponentes',
            'ponentes' => $ponentes,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }
    public static function crear (Router $router){
        if(!is_admin()){
            header ('Location:/login');
        }
        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header ('Location:/login');
            }
            //***** SUBIR IMAGENES ********* */
            // comprobamos que haya un archivo subido ( imagen)
            if(!empty($_FILES['imagen']['tmp_name'])){
                //creamos la carperta
                $carpetaImagenes ='../public/img/speakers';
                //si no esta la carpeta creada la creamos
                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes, 0755, true);

                }
                //los dos formatos que puede coger el archivo
                $imagen_png = image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                //generamos un nombre aleatorio
                $nombre_imagen = md5( uniqid( rand(), true));

                //añadimos al POST
                $_POST['imagen'] = $nombre_imagen;

                
            }
            
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);   

            //sincronizamos
            $ponente->sincronizar($_POST);
            
            
            //validamos los campos
            $alertas = $ponente->validar();

            
            
            //guardamos el registro
            if(empty($alertas)){
                //guardamos la imagen
                $imagen_png->save($carpetaImagenes .'/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpetaImagenes . '/'. $nombre_imagen . '.webp');

                $resultado = $ponente->guardar();

                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }

        }

        $router->render('admin/ponentes/crear', [
            'titulo'=>'Registrar Ponentes',
            'alertas'=> $alertas, 
            'ponente'=> $ponente,
            'redes'=> json_decode($ponente->redes)
        ]);
    }

    public static function editar (Router $router) {
        if(!is_admin()){
            header ('Location:/login');
        }
        $alertas = [];
        
        
        //validamos que el id sea un numero
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location:/admin/ponentes');

        }
        //validamos si el ponente existe
        $ponente = Ponente::find($id);
        if(!$ponente){
            header('Location:/admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header ('Location:/login');
            }
            if(!empty($_FILES['imagen']['tmp_name'])){
                //creamos la carperta
                $carpetaImagenes ='../public/img/speakers';
                //si no esta la carpeta creada la creamos
                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes, 0755, true);

                }
                //los dos formatos que puede coger el archivo
                $imagen_png = image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                //generamos un nombre aleatorio
                $nombre_imagen = md5( uniqid( rand(), true));

                //añadimos al POST
                $_POST['imagen'] = $nombre_imagen;
            
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            //sincronizamos 
            $ponente->sincronizar($_POST);
            //validamos
            $alertas = $ponente->validar();

            // si no hay alertas se guardan los cambios
            if(empty($alertas)){
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpetaImagenes .'/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpetaImagenes . '/'. $nombre_imagen . '.webp');

                }
                //guardamos
                $resultado = $ponente->guardar();
                if($resultado){
                    header('Location:/admin/ponentes');
                }
            }
        }
        

        $router->render('admin/ponentes/editar', [
            'titulo'=>'Editar Ponentes',
            'alertas'=> $alertas, 
            'ponente'=> $ponente,
            'redes'=> json_decode($ponente->redes)
        ]);

    }

    public static function eliminar(){
        if(!is_admin()){
            header ('Location:/login');
        }

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header ('Location:/login');
            }
            $id = $_POST['id'];

            $ponente = Ponente::find($id);

            if(isset($ponente)){
                header ('Location: /admin/ponentes');
            }
            
            $resultado = $ponente->eliminar();
            

            if($resultado){
                header ('Location:/admin/ponentes');
            }
            
        }
   
    }
}