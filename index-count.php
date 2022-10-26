<?php
require_once('core/helpers.php');
require_once('core/init.php');
/**
 * @var PDO $con
 */

$task_id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$stmt=$con->prepare('SELECT * FROM tasks t JOIN projects p on p.id=t.project_id WHERE p.id=:id');
$stmt->execute(['id'=>$task_id]);
$task_p=$stmt->fetchAll();

$indexContent = include_template('pages/main-template.php', ['show_complete_tasks'=>$show_complete_tasks,'tasks'=>$task_p]);
$page = include_template('layout.php' , [
    'is_auth'=>$is_auth,
    'content' => $indexContent,
    'projects'=>$projects,
    'all_tasks' => $all_tasks

]);
print($page);
