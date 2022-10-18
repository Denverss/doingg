<?php

require_once('core/helpers.php');
require_once ('core/init.php');
/**
 * @var PDO $con
 */


$title="Дела в порядке";



if(isset($_GET['id'])){
    $id=intval($_GET['id']??null);
    $tasks=getTasksByProjectId($con,$id);
}
else{
    $tasks=$all_tasks;
}

$indexContent = include_template('pages/main-template.php', compact('show_complete_tasks', 'tasks'));
$page = include_template('layout.php' , [
    'content' => $indexContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks
]);
print($page);



?>
