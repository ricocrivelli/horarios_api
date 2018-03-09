<?php
/**
 * @author: Rico Crivelli <ricardocrivelli@gmail.com>
 * @date: 09/03/2018 11:03
 */

$loader = require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'templates.path' => 'templates'
));

/** TURMAS */
$app->get('/turmas/', function() use ($app) {
	(new \controllers\Turmas())->getAll();
});
$app->get('/turmas/:id', function($id) use ($app) {
	(new \controllers\Turmas())->get($id);
});

/** HORARIOS DISCIPLINAS */
$app->get('/horarios/turma/:idTurma', function ($idTurma) use ($app) {
	(new controllers\HorariosDisciplinas())->getByIdTurma($idTurma);
});

$app->run();