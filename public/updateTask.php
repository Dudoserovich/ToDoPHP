<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

$task = $_POST['task'];
$id = $_POST['id'];
$datetime = date("Y-m-d H:i:s", strtotime($_POST['datetime']));

if ($task == '' || $datetime == '' || $id == '') {
    setcookie("typeNoty", "warning");
    setcookie("messageNoty", "Задайте все поля задачи");
} else {
    if (iconv_strlen($task) > 255) {
        setcookie("typeNoty", "danger");
        setcookie("messageNoty", "Слишком длинное задание (>255 символов)");
        header('Location: /ToDo');
        die();
    }

    $Task = new Task($task, $datetime, (int)$id);

    // выдавать сообщение об ошибке, если слишком длинный таск
    if ($Task->save()) {
        setcookie("typeNoty", "success");
        setcookie("messageNoty", "Задача обновлена");
    } else {
        setcookie("typeNoty", "warning");
        setcookie("messageNoty", "Задача не была изменена");
    }

}
header('Location: /ToDo');
