<?php
require_once __DIR__."/../vendor/autoload.php";

$controller = new Egroup\Controllers\PermissionsController();
var_dump($controller->checkPermissions('jonas', 'plant.seeds'));