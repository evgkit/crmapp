<?php
return [
    'id' => 'crmapp_console',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => require(__DIR__ . '/db.php')
    ]
];