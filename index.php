<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require_once 'db/procedure.php';

$app = new \Slim\App;
$app->post('/add-phrase', function (Request $request, Response $response) {

    $procedure = new Procedure();

    $data = $request -> getParsedBody();
    $phrase_data['phrase'] = filter_var($data['phrase'], FILTER_SANITIZE_STRING);
    
    $result = $procedure -> addPhrase($phrase_data['phrase']);
    $response -> getBody() -> write(json_encode($result));

    return $response;
});

$app->get('/get-phrases', function (Request $request, Response $response) {

    $procedure = new Procedure();
    $results = $procedure -> getPhrase();
    $response -> getBody()-> write(json_encode($results));

    return $response;
});

$app->run();