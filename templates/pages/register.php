<?php
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$registerContent=include_template('pages/register-template.php');

$page=include_template('layout.php', ['content'=>$registerContent, 'show_complete_template'=>$show_complete_tasks]);
print($page);
