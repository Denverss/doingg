<?php

$db = (require_once('core/config.php'))['db'];

$dsn = "{$db['driver']}:host={$db['host']};dbname={$db['dbName']};charset={$db['charset']}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$db['charset']} COLLATE {$db['collate']}"
];

try{
    $con = new PDO($dsn, $db['userName'], $db['password'], $options );
} catch(PDOException $e) {
    die("Подключение к серверу MySQL не удалось - {$e->getMessage()}");
}

$projectsObject= $con->query('SELECT * from projects');
$projects = $projectsObject->fetchAll();

$show_complete_tasks = rand(0, 1);

$isAuth=(bool) rand(0,1);

$all_tasks = getAllTasks($con);
