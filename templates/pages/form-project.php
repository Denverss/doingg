<?php
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$ProjectContent=include_template('templates/pages/form-project-template.php');


$page=include_template('Layout.php', [ 'content'=>$ProjectContent, 'show_complete_tasks'=>$show_complete_tasks]);
print ($page);
