<?php

require_once('templates/helpers.php');
require_once ('core/init.php');

/**
 * @var PDO $con
 */

$show_complete_tasks = rand(0, 1);
$title="Дела в порядке";

$tasksid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt=$con->prepare('SELECT t.id, t.title, t.date_create as project FROM tasks t JOIN projects p on t.project_id =p.id WHERE p.id=:id');
$stmt->execute(['id'=> $tasksid]);
$task=$stmt->fetch();



$projectsObject= $con->query('SELECT * from projects');
$projects= $projectsObject->fetchAll();
$tasksObject= $con->query('SELECT * from tasks');
$tasks = $tasksObject->fetchAll();

$content=include_template('main.php',['show_complete_tasks'=>$show_complete_tasks, 'projects'=>$projects, 'tasks'=>$tasks,'task'=>$task]);

$page=include_template('Layout.php', [ 'title'=>$title,'show_complete_tasks'=>$show_complete_tasks, 'projects'=>$projects, 'tasks'=>$tasks]);
echo $page;



?>
