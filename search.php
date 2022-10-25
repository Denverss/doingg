<?php
require_once('core/init.php');
$searchtext = filter_input( INPUT_GET,'search', FILTER_SANITIZE_STRING);

$stmt = $con->prepare('SELECT t.id,
                        t.title,
                        t.date_end,
                        p.title AS project
                        FROM tasks t
                        JOIN projects p ON t.project_id=p.id
                        WHERE MATCH(t.title) AGAINST(:searchtext)'
                        );

$stmt->execute(['searchtext'=> $searchtext]);

$searchtasks=$stmt->fetchAll();

$searchcontent =include_template('pages/main-template.php',['is_auth'=>$is_auth,
'content'=> $searchcontent]);

$page =include_template('layout.php',[
    'is_auth'=>$is_auth,
    'content'=>$searchcontent
]);
print($page);
