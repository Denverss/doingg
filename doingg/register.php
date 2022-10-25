<?php
require_once('core/helpers.php');
require_once ('core/init.php');

var_dump($_POST);
$errors=[];
$user=$_POST;
$rules=[
    'name'=>function(){
    return validateFilledRegister('name');
    },
    'email'=>function($email){
    return validateEmail('email');
},
    'password'=>function(){
    return validateFilledRegister('password');
    }

];
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $user=$_POST;
    foreach ($user as $key =>$value){
        if(isset($rules[$key])){
            $rule=$rules[$key];
            $errors[$key]=$rule($value);
        }
    }
    $errors = array_filter($errors);
}
var_dump($errors);



if($_SERVER['REQUEST_METHOD']=='POST' && empty($errors)){
    $user['password']= password_hash($user['password'], PASSWORD_DEFAULT);//хэшируем пароль
    //выполняем запрос на получение пользователям с указанным email
    $stmt =$con->prepare('SELECT * from users WHERE email=:email' );
    $stmt->execute(['email'=>$user['email']]);

    //если количество не равно нулю, то пользователь с такой почтой уже есть, добавить нельзя, формируем ошибку
    if ($stmt->rowCount() != 0){
        $errors['email'] =' Пользователь с этим email уже зарегистрирован';
    }
    else {
        $stmt = $con->prepare('INSERT INTO users SET nickname=:name, email=:email,password=:password');
        $stmt->execute($user);
        header('Location: authorization.php');
    }


}

$registercontent = include_template('pages/register-template.php',['errors'=>$errors]);
$page = include_template('layout.php' , [
    'content' => $registercontent,
    'projects'=>$projects,
    'all_tasks' => $all_tasks,
    'isAuth'=>$isAuth

]);
print($page);
