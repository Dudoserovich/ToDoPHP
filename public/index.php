<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dudoserovich\ToDoPhp\Task;

function renderPage($data) {
    // Twig
    $loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
    $view = new \Twig\Environment($loader);
    try {
        echo $view->render('index.html.twig', ['tasks' => $data ?? array()]);
    } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {
        echo $e;
    }
}

setcookie("typeNoty", null, time()-3600);
setcookie("messageNoty", null, time()-3600);

try {
    renderPage(Task::getAll());

    if (isset($_COOKIE['typeNoty'])) {
        echo "<script> displayNotification('{$_COOKIE['messageNoty']}', '{$_COOKIE['typeNoty']}') </script>";
    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}