<?php
declare(strict_types=1);

use App\Application\Actions\Property\PropertiesListAction;
use App\Application\Actions\Property\PropertyViewAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', PropertiesListAction::class)->setName('property-list');
    $app->get('/property/{id}', PropertyViewAction::class)->setName('property-item');
};
