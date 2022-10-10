<?php 
require_once('templates/helpers.php');

$show_complete_tasks = rand(0, 1);

$guestContent=include_template('pages/guest-template.php');

$page=include_template('layout.php', ['content'=>$guestcontent, 'show_complete_template'=>$show_complete_tasks ]);
print($page);