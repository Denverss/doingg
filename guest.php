<?php
require_once('core/helpers.php');
require_once ('core/init.php');

$guestcontent = include_template('pages/guest-template.php');
$page = include_template('layout.php' , [
    'content' => $guestcontent,
    'projects'=>$projects,
    'all_tasks' => $all_tasks,
    'is_auth'=>$is_auth
]);
print($page);
