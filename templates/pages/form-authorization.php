<?php
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$LoginContent=include_template('pages/form-autorization-template.php');

$page=include_template('layout.php', ['content'=>$LoginContent, 'show_complete_template'=>$show_complete_tasks ]);
print($page);
