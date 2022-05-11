<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

$task = $_POST['task'];
$deadline = date("Y-m-d H:i:s", strtotime($_POST['deadline']));

if ($task == '' || $_POST['deadline'] == '') {
    setcookie("typeNoty", "warning");
    setcookie("messageNoty", "Задайте все поля задачи");
} else {

    if (iconv_strlen($task) > 255) {
        setcookie("typeNoty", "danger");
        setcookie("messageNoty", "Слишком длинное задание (>255 символов)");
        header('Location: /');
        die();
    }

    $Task = new Task($task, $deadline);

    if(!$Task->add())
    {
        setcookie("typeNoty", "danger");
        setcookie("messageNoty", "Такое задание уже существует");
    } else {
        setcookie("typeNoty", "success");
        setcookie("messageNoty", iconv_strlen($task) > 255 . "Задание добавлено");
    }

}
header('Location: /');