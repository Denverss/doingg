<?php

require_once('core/helpers.php');
require_once ('core/init.php');
/**
 * @var PDO $con
 * @var array $tasks_id
 */


$title="Дела в порядке";



if(isset($_GET['id'])){
    $id=intval($_GET['id']??null);
    $tasks=getTasksByProjectId($con,$id);
}
else{
    $tasks=$all_tasks;
}


$indexContent = include_template('pages/main-template.php', ['show_complete_tasks'=>$show_complete_tasks,'tasks'=>$tasks_id]);
$page = include_template('layout.php' , [
    'is_auth'=>$is_auth,
    'content' => $indexContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks

]);
print($page);



?>
