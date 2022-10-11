<?php 
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$TaskContent=include_template('pages/tasks-template.php');

$page=include_template('layout.php', ['content'=>$taskscontent, 'show_complete_template'=>$show_complete_tasks ]);
print($page);