<?php
require_once('core/helpers.php');
require_once('core/init.php');
var_dump($_POST);
$errors=[];

$new_task=$_POST;

$addContent=include_template('pages/form-task-template.php',[
    'projects'=>$projects,
    'errors'=>$errors
]);

$title = 'Добавить задачу';

$page = include_template('layout.php',[
    'content'=>$addContent,
    'title'=> $title,
    'projects'=>$projects,
    'all_tasks' => $all_tasks]);

print ($page);


$errors=[];
$projects_ids=array_column($projects,'id');
$post=$_POST;
$rules= [
    'project_id' =>function($value) use ($projects_ids){
        return validateProject($value,$projects_ids);
    },
    'title'=>function(){
        return validateFilled('title');
    },
    'date_end'=>function(){
        return validateDateEnd('date_end');
    },


];

$file_rule = function (){
    if(!validateImage()){
        return "Загрузите картинку в формате jpg,jpeg или png";
    }
};

if ($_SERVER['REQUEST_METHOD']=='POST'){
    foreach ($post as $key =>$value){
        if(isset($rules[$key])){
            $rule=$rules[$key];
            $errors[$key]=$rule($value);
        }
    }
    $errors['photo']=$file_rule();
}
$errors = array_filter($errors);
