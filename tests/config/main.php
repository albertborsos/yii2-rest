<?php

$config = [
    'id' => 'ddd-test',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => getenv('DB_TEST_DSN'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
    'container' => [
        'definitions' => [
            \albertborsos\ddd\interfaces\HydratorInterface::class => \albertborsos\ddd\hydrators\ActiveHydrator::class,
            \albertborsos\ddd\tests\support\base\domains\customer\interfaces\CustomerActiveRepositoryInterface::class => \albertborsos\ddd\tests\support\base\domains\customer\mysql\CustomerActiveRepository::class,
            \albertborsos\ddd\tests\support\base\domains\customer\interfaces\CustomerAddressActiveRepositoryInterface::class => \albertborsos\ddd\tests\support\base\domains\customer\mysql\CustomerAddressActiveRepository::class,
        ],
    ],
];

$localConfigFile = dirname(__FILE__) . '/main.local.php';

$localConfig = [];
if (is_file($localConfigFile)) {
    $localConfig = require($localConfigFile);
}

return \yii\helpers\ArrayHelper::merge($config, $localConfig);
