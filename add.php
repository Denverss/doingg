<?php
require_once('core/helpers.php');
require_once('core/init.php');

$errors=[];

$new_task=$_POST;

$addContent=include_template('pages/form-task-template.php',['projects'=>$projects]);

$title = 'Добавить задачу';

$page = include_template('layout.php',[
    'content'=>$addContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks]);

print ($page);


//$errors=[];
//$projects_ids=array_column($projects,'id');
//$task=$_POST;
//$rules= [
//    'project_id' =>function($value) use ($projects_ids){
//        return validateProject($value,$projects_ids);
//    },
//];
