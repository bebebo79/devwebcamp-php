<?php
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\EventoRegistro;
use Model\Hora;
use Model\Registro;
use MVC\Router;
use Model\Usuario;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;






class RegistrosController {
    
    public static function crear(Router $router){
        if(!is_auth()){
            header ('Location:/login');
            return;
        }
        //verificamos si ese usuario ya tiene un registro
        $registro = Registro:: where('usuario_id', $_SESSION['id']);

        if(isset($registro) &&  ($registro->paquete_id === "3" || $registro->paquete_id === "2") ){
            header('Location:/entrada?id=' . urlencode($registro->token));
            return;
        }
        if(isset($registro) && $registro->paquete_id === "1") {
            header('Location: /finalizar-registro/conferencias');
            return;
        }

        


       $router->render('registros/crear', [
            'titulo' =>'Finalizar Registro'
       ]);
    } 
    public static function gratis(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // validar que esta autenticado el usuario
            if(!is_auth()){
                header ('Location:/login');
                return;
            }
            //verificamos si ese usuario ya tiene un registro
            $registro = Registro:: where('usuario_id', $_SESSION['id']);

            if(isset($registro) &&  $registro->paquete_id === "3") {
                header('Location:/entrada?id=' . urlencode($registro->token));
                return;

        }
           $token = substr(md5(uniqid(rand(), true)), 0, 8);

           // crear un registro
           $datos = array(
               'paquete_id' => 3,
               'pago_id' => '',
               'token'=> $token,
               'usuario_id'=>$_SESSION['id']

           );

           $registro = new Registro($datos);

           $resultado = $registro->guardar();

           if($resultado){
            header ('Location:/entrada?id=' . urlencode($registro->token));
            return;
           }
        


        }
    }
    public static function entrada (Router $router){
        if(!is_auth()){
            header ('Location:/login');
            return;
        }

        // validamos la url
        $id = $_GET['id'];
        if(!$id || strlen($id) !== 8 ) {
            header('Location: /');
            return;
        }
        // validamos que este en nuestra base de datos
        $registro = Registro::where('token', $id);

        if(!$registro){
            header('Location: /');
            return;
        }

        // llenar nuestro resultado
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        

        $router->render('registros/entrada', [
             'titulo' =>'Asistencia a DevWebCamp',
             'registro'=> $registro
        ]);
    }
    public static function pagar(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // validar que esta autenticado el usuario
            if(!is_auth()){
                header ('Location:/login');
                return;
            }
            // validar que no esta vacio el post

            if(empty($_POST)){
                echo json_encode([]);
                return;
            }
          
            // crear un registro
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];

            
            
            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
                
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado'=> 'error'
                ]);
            }

        }
    }
    public static function conferencias (Router $router){
        if(!is_auth()){
            header('Location:/login');
            return;
        }
        // validar que los usuarios tengan el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);


        if(isset($registro) && $registro->paquete_id ==="2") {
            header('Location:/entrada?id=' . urlencode($registro->token));
            return;
        
        } 
        if($registro->paquete_id !== "1" ){
            header('Location: /');
            return;
        }
               
        //redireccionar una vez que el usuario se ha registrado en los eventos
        if($registro->paquete_id === "1"){
            header ('Location:/entrada?id=' . urlencode($registro->token));
            return;
        }
        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = [];

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);


            if($evento->dia_id === '1' && $evento->categoria_id === '1'){
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id === '2' && $evento->categoria_id === '1'){
                $eventos_formateados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id === '1' && $evento->categoria_id === '2'){
                $eventos_formateados['workshops_v'][] = $evento;
            }
            if($evento->dia_id === '2' && $evento->categoria_id === '2'){
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $regalos = Regalo::all("ASC");

        // pasamos los datos de registro al POST

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // que el usuario este autenticado
            if(!is_auth()){
                header('Location:/login');
                return;
            }
            $eventos = explode(',' , $_POST['eventos']);
            if(empty($eventos)){
                echo json_encode(['resultado'=> false]);
                return;
            }        
            //obtener el registro del usuario
            $registro =  Registro::where('usuario_id', $_SESSION['id']);
            if(!isset($registro) && $registro->paquete_id !== "1"){
                echo json_encode(['resultado'=> false]);
                return;
            }
            //obtener la disponibilidad de los eventos seleccionados
            $eventos_array = [];

            foreach($eventos as $evento_id){
                $evento = Evento::find($evento_id);
               
                if(!isset($evento) || $evento->disponibles === "0"){
                    echo json_encode(['resultado'=> false]);
                    return;
                }
                $eventos_array[] = $evento;
            }
            foreach($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->guardar();

                // almacenar el registro
                $datos = [
                    'evento_id'=> (int) $evento->id,
                    'registro_id'=> (int) $registro->id
                ];
                $registro_usuario = new EventoRegistro($datos);
                $registro_usuario->guardar();
            }
            //almacenar el regalo
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();
            if($resultado){
                echo json_encode([
                    'resultado' => $resultado,
                    'token' => $registro->token
                    
            ]);
            

            }else {
                echo json_encode(['resultado'=> false]);
            }
            return;            

        } 
        $router->render('registros/conferencias', [
             'titulo' =>'Elige WorksShop y/o Conferencia',
             'eventos'=>$eventos_formateados,
             'regalos' => $regalos
             
        ]);
    }  
}