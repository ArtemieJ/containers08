<?php
require_once __DIR__ . '/testframework.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modules/database.php';
require_once __DIR__ . '/../modules/page.php';

$tests = new TestFramework();

function testDbConnection() {
    global $config;
    $db = new Database($config["db"]["path"]);
    return assertExpression($db !== null, 'Database connected', 'Database failed');
}

function testDbCount() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $count = $db->Count("page");
    return assertExpression($count == 3, 'Correct row count', 'Incorrect row count');
}

// adauga aici celelalte teste (Create, Read, Update, Delete etc.)

$tests->add('Database connection', 'testDbConnection');
$tests->add('Table count', 'testDbCount');
$tests->run();
echo $tests->getResult();
