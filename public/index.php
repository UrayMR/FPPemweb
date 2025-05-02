<?php

require_once __DIR__ . '/../core/App.php';
require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../core/Connection.php';
require_once __DIR__ . '/../routes/web.php';

$app = new App();
$app->run();
