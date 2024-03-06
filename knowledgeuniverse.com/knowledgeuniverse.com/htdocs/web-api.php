<?php

require_once 'src/back-end/libs/load.php';

$api = new API();
try {
    $api->processApi();
} catch (Exception $e) {
    $api->die($e);
}