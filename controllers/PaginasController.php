<?php
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;



class PaginasController {
    public static function index(Router $router){
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

        //obtener los totales de cada bloque
        $total_ponentes = Ponente::total();
        $total_conferencias = Evento::total('categoria_id', 1);
        $total_workshops = Evento::total('categoria_id', 2);

        //obtener todos los ponentes
        $ponentes = Ponente::all();

       

        $router->render('paginas/index',[
            'titulo'=> 'Inicio',
            'eventos' =>$eventos_formateados, 
            'total_ponentes'=>$total_ponentes,
            'total_conferencias'=>$total_conferencias,
            'total_workshops' =>$total_workshops,
            'ponentes'=>$ponentes
        ]);

    }
    public static function eventos(Router $router){

        $router->render('paginas/devwebcamp',[
            'titulo'=> 'Sobre DevWebCamp'
        ]);

    }
    public static function paquetes(Router $router){

        $router->render('paginas/paquetes',[
            'titulo'=> 'Paquetes DevWebCamp'
        ]);

    }
    public static function conferencias(Router $router){
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

        

        $router->render('paginas/workshops-conferencias',[
            'titulo'=> 'WorkShops & Conferencias',
            'eventos'=> $eventos_formateados
        ]);

    }
    public static function error(Router $router) {

        $router->render('paginas/error',[
            'titulo'=> 'Página no encontrda'
            
        ]);
    }

}
