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
    if(!empty($_FILES['file']['name'])) {
        $file_name = $_FILES['file']['name'];
        $uniq_url = uniqid();
        $task['file'] = 'uploads/' . $uniq_url . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $task['file']);
    }
    else {
        $task['file'] = null;
    }
    $task['user_id']=$_SESSION['user_id'];
    $inf =$con->prepare('INSERT INTO tasks SET title=:title, project_id=:project, date_end=:due_date, file=:file, user_id=:user_id');
    $inf->execute($task);
    var_dump(1);
    header("Location: index.php");

}



$addContent=include_template('pages/form-task-template.php',[
    'projects'=>$projects,
    'errors'=>$errors
]);

$page = include_template('layout.php',[
    'content'=>$addContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks,
    'is_auth'=>$is_auth
]);

print ($page);
