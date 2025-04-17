<?php
namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;



class DashboardController {
    public static function index(Router $router){
        
        //Obtener los ultimos usuarios registrados
        $registros= Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        //obtener los ingresos
        $virtual = Registro::total('paquete_id', 2);
        $presencial = Registro::total('paquete_id', 1);

        $ingresos = ($virtual * 46.41) + ($presencial * 189.54);

        //obtener los eventos con mas y con menos plazas disponibles
        $menos_plazas = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $mas_plazas = Evento::ordenarLimite('disponibles', 'DESC', 5);

       $router->render('admin/dashboard/index', [
            'titulo'=> 'Panel de Administracion',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_plazas' => $menos_plazas,
            'mas_plazas' => $mas_plazas       
        ]);
    } 
}