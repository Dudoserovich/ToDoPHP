<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

$id = $_POST['id'];

if ($id != '') {
    Task::remove($id);
    setcookie("typeNoty", "success");
    setcookie("messageNoty", "Задача успешно удалена");
} else {
    setcookie("typeNoty", "warning");
    setcookie("messageNoty", "Задача не была удалена");
}

header('Location: /');