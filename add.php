<?php

require_once('core/helpers.php');
require_once('core/init.php');

$errors=[];

$title = 'Добавить задачу';

$projects_ids=array_column($projects,'id');

$rules= [
    'project' =>function($id) use ($projects_ids){
        return validateProject($id, $projects_ids);
    },
    'title'=>function($title) {
        return validateFilled($title);
    },
    'due_date'=>function($date){
        $errordateend = validateDateEnd($date);
        if ($errordateend){
            return $errordateend;
        }
       $errordate = validateFuturedate($date);
       if ($errordate){
           return $errordate;
       }
    },
];

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $task = $_POST;
    foreach ($task as $key =>$value){
        if(isset($rules[$key])){
            $rule=$rules[$key];
            $errors[$key]=$rule($value);
        }
    }
    $errors = array_filter($errors);
}

var_dump($errors);

if ($_SERVER['REQUEST_METHOD']=='POST' && empty($errors)) {
    $inf =$content->prepare('INSERT INTO post SET title=:title, project=:id, due_date=:date, file=:file');
    var_dump(1);
}



$addContent=include_template('pages/form-task-template.php',[
    'projects'=>$projects,
    'errors'=>$errors
]);

$page = include_template('layout.php',[
    'content'=>$addContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks
]);

print ($page);
