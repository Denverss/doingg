<?php

require_once('templates/helpers.php');
require_once ('core/init.php');

/**
 * @var PDO $con
 */

$show_complete_tasks = rand(0, 1);
$title="Дела в порядке";



$projectsObject= $con->query('SELECT * from projects');
$projects= $projectsObject->fetchAll();
$tasksObject= $con->query('SELECT * from tasks');
$tasks = $tasksObject->fetchAll();

$content=include_template('main.php',['show_complete_tasks'=>$show_complete_tasks, 'projects'=>$projects, 'tasks'=>$tasks]);

$page=include_template('Layout.php', [ 'title'=>$title,'show_complete_tasks'=>$show_complete_tasks, 'projects'=>$projects, 'tasks'=>$tasks]);
echo $page;



?>
