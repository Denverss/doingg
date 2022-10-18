<?php
/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date) : bool {
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form (int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

/**
 *
 *
 */
function count_project ($tasks, $project_name){
    $i=0;
    foreach ($tasks as $task){
        if($task["project_name"]===$project_name){
            $i++;
        }
        else{
            continue;
        }
    }
    return $i;
}
function getTime($fe_date)
{
    date_default_timezone_set("Europe/Moscow");
    $timestamp = strtotime($fe_date) - time();
    $hours = floor($timestamp / 3600);
    $min = floor(($timestamp % 3600) / 60);
    return $hours;
}
function getAllTasks($con) {
    $tasksObject =$con->query('SELECT
	t.title,
    t.date_end,
    t.is_done,
    t.file,
    p.title as project_name
	FROM `tasks` t JOIN projects p ON t.project_id = p.id');
    return $tasksObject->fetchAll();
}
function getTasksByProjectId($con, $id) {
    $stmt = $con->prepare('SELECT
	t.title,
    t.date_end,
    t.is_done,
    t.file,
    p.title as project_name
	FROM `tasks` t JOIN projects p ON t.project_id = p.id
    WHERE t.project_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function validateProject(int $id,array $allowed_list){
    if(!in_array($id,$allowed_list)){
        return "Указано несуществующее название проекта";
    }
}
function validateImage(){
    if (!empty($_FILES['photo']['name'])){
        $finfo=finfo_open(FILEINFO_MIME_TYPE);
        $tmp_name=$_FILES['photo']['tmp_name'];
        $file_type=finfo_file($finfo,$tmp_name);
        if($file_type !=="image/jpeg" && $file_type !== "image/png" && $file_type !== "image/png"){
            return false;
        }
        return true;
    }   else{
        return false;
    }
}
function validateFilled(){

}

