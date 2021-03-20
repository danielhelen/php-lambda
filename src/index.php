<?php declare(strict_types=1);

$lambdaContext = json_decode($_SERVER['LAMBDA_INVOCATION_CONTEXT'], true);
$requestContext = json_decode($_SERVER['LAMBDA_REQUEST_CONTEXT'], true);

echo 'Hello World! This was echoed out by some PHP running in a Lambda function.';

echo '<br><br>';

echo 'Lambda Context:<br>';
echo print_r($lambdaContext, true);

echo '<br><br>';

echo 'Request Context:<br>';
echo print_r($requestContext, true);
