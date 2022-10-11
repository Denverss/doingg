<?php
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$TaskContent=include_template('pages/tasks-template.php');

$page=include_template('index.php', ['content'=>$TaskContent, 'data'=>$data, 'title'=>$title,'show_complete_tasks'=>$show_complete_tasks, 'categories'=>$categories, 'posts'=>$posts]);
echo $page;
