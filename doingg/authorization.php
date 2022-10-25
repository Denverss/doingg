<?php
require_once('core/helpers.php');
require_once ('core/init.php');

var_dump($_POST);
$errors=[];
$user=$_POST;
$rules=[
    'email'=>function($email){
        return validateEmail('email');
    },
    'password'=>function(){
        return validateFilledRegister('password');
    }

];
if ($_SERVER['REQUEST_METHOD']=='POST'){
    foreach ($user as $key =>$value){
        if(isset($rules[$key])){
            $rule=$rules[$key];
            $errors[$key]=$rule($value);
        }
    }
    
}
$errors = array_filter($errors);



if($_SERVER['REQUEST_METHOD']=='POST' && empty($errors)){
    $stmt =$con->prepare('SELECT * from users WHERE email=:email' );
    $stmt->execute(['email'=>$user['email']]);

    //если количество не равно нулю, то пользователь с такой почтой уже есть, добавить нельзя, формируем ошибку
    if ($stmt->rowCount() == 0){
        $errors['email'] =' Пользователь с этим email нет';
    } 
    else{
        $dbUser = $stmt->fetch();//получили данные из бд
        if(password_verify($user['password'],$dbUser['password'])){//сравниваем хэш пароля из бд с введенным
            $_SESSION['user_id']=$dbUser['id'];
            $_SESSION['user_name']=$dbUser['nickname'];
            header('Location:index.php');
        } else{
            $errors['password']='Неверный пароль';
        }
    }
}

$authorizationcontent = include_template('pages/form-authorization-template.php',['errors'=>$errors]);
$page = include_template('layout.php' , [
    'content' => $authorizationcontent,
    'projects'=>$projects,
    'all_tasks' => $all_tasks,
    'is_auth'=>$is_auth

]);
print($page);
