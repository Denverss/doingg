<?php

require_once ('templates/helpers.php');

$show_complete_tasks = rand(0, 1);
$categories=["Входящие",
    "Учеба",
    "Работа",
    "Домашние дела",
    "Авто"];
$posts = [
    [
        "title"=>"Собеседование
        в IT компании",
        "data"=>"01.12.2019",
        "categories"=>"Работа",
        "is_done"=>false
    ],
    [
        "title"=>"Выполнить тестовое
        задание",
        "data"=>"25.12.2019",
        "categories"=>"Работа",
        "is_done"=>false
    ],
    [
        "title"=>"Сделать задание первого
        раздела",
        "data"=>"21.12.2019",
        "categories"=>"Учеба",
        "is_done"=>true
    ],
    [
        "title"=>"Встреча с другом",
        "data"=>"22.12.2019",
        "categories"=>"Входящие",
        "is_done"=>false
    ],
    [
        "title"=>"Купить корм для кота",
        "data"=>"null",
        "categories"=>"Домашние дела",
        "is_done"=>false
    ],
    [
        "title"=>"Заказать пиццу",
        "data"=>"null",
        "categories"=>"Домашние дела",
        "is_done"=>false
    ],
];

$title="Дела в порядке";

$content=include_template('main.php',['show_complete_tasks'=>$show_complete_tasks, 'categories'=>$categories, 'posts'=>$posts]);

$page=include_template('layout.php', ['content'=>$content, 'title'=>$title, ]);
print($page);

?>
