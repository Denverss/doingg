<?php
require_once ('helpers.php');
require_once('core/init.php');

$addContent=include_template('templates/pages/form-tasks-template.php',['projects'=>$projects]);

$show_complete_tasks = rand(0, 1);
$page = include_template('layout.php',[
    'show_complete_tasks'=>$show_complete_tasks,
    'content'=>$addContent]);
$errors=[];
$projects_ids=array_column($projects,'id');
$task=$_POST;
$rules= [
    'project_id' =>function($value) use ($projects_ids){
        return validateProject($value,$projects_ids);
    },
];
