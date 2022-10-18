<?php

require_once('templates/helpers.php');
require_once ('core/init.php');

/**
 * @var PDO $con
 */

$show_complete_tasks = rand(0, 1);
$title="Дела в порядке";
$all_tasks = getAllTasks($con);

$projectsObject= $con->query('SELECT * from projects');
$projects= $projectsObject->fetchAll();
if(isset($_GET['id'])){
    $id=intval($_GET['id']??null);
    $tasks=getTasksByProjectId($con,$id);
}
else{
    $tasks=$all_tasks;
}

$indexContent = include_template('main.php', compact('show_complete_tasks', 'projects', 'tasks', 'all_tasks'));
$page = include_template('layout.php' , [
    'content' => $indexContent,
    'title'=> $title,
    'projects'=>$projects
]);
print($page);



?>
