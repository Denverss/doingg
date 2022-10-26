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

$all_tasks = getAllTasks($con);

session_start();
$is_auth = isset($_SESSION['user_id']);
if ($is_auth){
   $stmt =$con->prepare('SELECT * from projects WHERE user_id=:user_id');
   $stmt->execute(['user_id'=>$_SESSION['user_id']]);
   $projects=$stmt->fetchAll();

   $stmt =$con->prepare('SELECT t.id, p.id , t.title, p.title AS project,t.file, t.date_end, t.is_done from tasks t JOIN projects p on t.project_id=p.id WHERE t.user_id=:user_id');
   $stmt->execute(['user_id'=>$_SESSION['user_id']]);
   $tasks_id=$stmt->fetchAll();
}
else{
    $is_auth = '';
    $tasks_id=[];
}
