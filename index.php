<?php

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\Basic\HelpRequestHandler;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;

require 'vendor/autoload.php';
require 'Handlers/ClassyCleverInsultsIntentRequestHandler.php';

/**
 * Classy and Clever Insults request handling workflow
 * Based on https://github.com/maxbeckers/amazon-alexa-php/blob/master/examples/simple-intent-request.php
 */
$requestBody = file_get_contents('php://input');
if ($requestBody) {
    $alexaRequest = Request::fromAmazonRequest($requestBody, $_SERVER['HTTP_SIGNATURECERTCHAINURL'], $_SERVER['HTTP_SIGNATURE']);
    // Request validation
    $validator = new RequestValidator();
    $validator->validate($alexaRequest);
    // add handlers to registry
    $responseHelper         = new ResponseHelper();
    $helpRequestHandler     = new HelpRequestHandler($responseHelper, 'You can ask me to give you a classy and clever insult to make a beautiful comeback.', ['amzn1.ask.skill.6e748299-5ea1-4924-890a-e98ee4c19cae']);
    $mySimpleRequestHandler = new ClassyCleverInsultsIntentRequestHandler($responseHelper);
    $requestHandlerRegistry = new RequestHandlerRegistry([$helpRequestHandler, $mySimpleRequestHandler]);
    // handle request
    $requestHandler = $requestHandlerRegistry->getSupportingHandler($alexaRequest);
    $response       = $requestHandler->handleRequest($alexaRequest);
    // render response
    header('Content-Type: application/json');
    echo json_encode($response);
}
exit();
?>