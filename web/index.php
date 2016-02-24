<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// Включаем Yii
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

//ini_set('display_errors', true);

// Получаем конфигурацию
$config = require(__DIR__ . '/../config/web.php');

// Ран Вася ран!
(new yii\web\Application($config))->run();