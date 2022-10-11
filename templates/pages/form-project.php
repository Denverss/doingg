<?php 
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$ProjectContent=include_template('pages/form-project-template.php');

$page=include_template('layout.php', ['content'=>$Projectcontent, 'show_complete_template'=>$show_complete_tasks ]);
print($page);