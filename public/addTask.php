<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

$task = $_POST['task'];
$deadline = date("Y-m-d H:i:s", strtotime($_POST['deadline']));

if ($task == '' || $_POST['deadline'] == '') {
    setcookie("typeNoty", "warning");
    setcookie("messageNoty", "Задайте все поля задачи");
    header('Location: /');
} else {
    /*htmlspecialchars($task, ENT_QUOTES)*/
    // выдавать сообщение об ошибке, если слишком длинный таск
    // ограничить ввод даты (нельзя ставить уже прошедшие дни)
    $Task = new Task($task, $deadline);

    if($Task->add())
        header('Location: /');
    else {
        setcookie("typeNoty", "danger");
        setcookie("messageNoty", "Такая запись уже существует");
        header('Location: /');
    }
}