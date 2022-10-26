<?php

require_once('core/helpers.php');
require_once('core/init.php');
var_dump($_POST);
$errors=[];

$project=$_POST;
$title = 'Добавить проект';
$rules=[
'title'=>function() {
    return validateProjectAdd($_POST);
}
];
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $project = $_POST;
    foreach ($project as $key =>$value){
        if(isset($rules[$key])){
            $rule=$rules[$key];
            $errors[$key]=$rule($value);
        }
    }
    $errors = array_filter($errors);
}

var_dump($errors);
if ($_SERVER['REQUEST_METHOD']=='POST' && empty($errors)) {
    $project['user_id']=$_SESSION['user_id'];
    $stmt =$con->prepare('INSERT INTO projects SET title=:title, user_id=:user_id');
    $stmt->execute($project);
    header("Location: index.php");
}

$addProjectContent=include_template('pages/form-project-template.php',[
    'errors'=>$errors
]);

$page = include_template('layout.php',[
    'content'=>$addProjectContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks,
    'is_auth'=>$is_auth
]);

print ($page);

