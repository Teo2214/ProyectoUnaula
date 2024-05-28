<?php 

require_once __DIR__ . '/../includes/app.php';

use Controller\AgentesController;
use Controller\LoginController;
use Controller\PrincipalController;
use Controller\APIController;
use MVC\Router;

$router = new Router();

//Iniciar sesion
//tenemos la funcion de rutas que requieren un url y una funcion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);//los post en este caso lee la contraseña

//crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

//confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//AREA PRIVADA
$router->get('/principal', [PrincipalController::class,'index']);

//Vehiculo
$router->get('/vehiculo', [PrincipalController::class,'vehiculo']);

//vehiculo user
$router->get('/vehiculoUser', [PrincipalController::class,'vehiculoUser']);

//multas de usuario
$router->get('/multaUser', [PrincipalController::class,'multaUser']);

//pagina de agentes
$router->get('/principalAgente', [AgentesController::class,'principalAgente']);

//multas de agentes
$router->get('/multas', [AgentesController::class,'multas'] );
$router->get('/multaMetodo', [AgentesController::class,'multaMetodo']);

//API de multa
$router->get('/api/servicios', [APIController::class,'index'] );
$router->post('/api/multa', [APIController::class,'guardar']);
$router->post('/api/eliminar', [APIController::class,'eliminar']);

//picoPlaca
$router->get('/picoPlaca', [AgentesController::class,'picoPlaca']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();