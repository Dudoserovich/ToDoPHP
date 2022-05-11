<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

$task = $_POST['task'];
$id = $_POST['id'];
$datetime = date("Y-m-d H:i:s", strtotime($_POST['datetime']));

if ($task == '' || $datetime == '' || $id == '') {
    setcookie("typeNoty", "warning");
    setcookie("messageNoty", "Задайте все поля задачи");
    header('Location: /');
} else {
    $Task = new Task($task, $datetime, (int)$id);

    // выдавать сообщение об ошибке, если слишком длинный таск
    // ограничить ввод даты (нельзя ставить уже прошедшие дни)
    if ($Task->save()) {
        setcookie("typeNoty", "success");
        setcookie("messageNoty", "Задача обновлена");
    } else {
        setcookie("typeNoty", "warning");
        setcookie("messageNoty", "Задача не была изменена");
    }

    header('Location: /');
}