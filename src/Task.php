<?php

namespace Dudoserovich\ToDoPhp;

use PDO;

class Task extends ActiveRecord
{
    private ?int $id;
    private string $task;
    private string $datetime;

    public function __construct($task, $datetime, $id = null)
    {
        $this->id = $id;
        $this->task = $task;
        $this->datetime = $datetime;
    }

    public function save(): bool
    {
        $taskByFields = Task::getByFields($this->task, $this->datetime);

        if ($taskByFields->task != $this->task && $taskByFields->datetime != $this->datetime) {
            self::connect();
            $connect = self::getConnection();

            $insertQuery = 'UPDATE tasks set task=:task,datetime=:datetime WHERE id=:id';
            $query = $connect->prepare($insertQuery);
            $query->execute(['task' => $this->task, 'datetime' => $this->datetime, 'id' => $this->id]);

            self::unsetConnect();
            return true;
        } else return false;
    }

    public static function remove($id): void
    {
        // если запись найдена, удаляем
        if (Task::getById($id)) {
            self::connect();
            $connect = self::getConnection();

            $insertQuery = 'DELETE FROM `tasks` WHERE `id`=?';
            $query = $connect->prepare($insertQuery);
            $query->execute([$id]);

            self::unsetConnect();
        }
    }

    public static function getById($id)
    {
        self::connect();
        $connect = self::getConnection();

        $insertQuery = 'SELECT * FROM `tasks` WHERE `id`=?';
        $query = $connect->prepare($insertQuery);
        $query->execute([$id]);
        $foundTask = $query->fetch();

        self::unsetConnect();

        if ($foundTask == false)
            return false;
        else return new Task($foundTask['task'], $foundTask['datetime']);
    }

    public static function getByFields($task, $datetime)
    {
        self::connect();
        $connect = self::getConnection();

        $selectQuery = 'SELECT * from tasks where task=:task AND datetime=:datetime';
        $selectQuery = $connect->prepare($selectQuery);
        $selectQuery->execute(['task' => $task, 'datetime' => $datetime]);
        $foundTask = $selectQuery->fetch();

        self::unsetConnect();

        if ($foundTask == false)
            return false;
        else return new Task($foundTask['task'], $foundTask['datetime']);
    }

    public function add(): bool
    {
        // Если такой записи нет, добавляем
        $foundTask = self::getByFields($this->task, $this->datetime);
        if (!$foundTask) {
            self::connect();
            $connect = self::getConnection();

            $insertQuery = 'INSERT INTO tasks(task,datetime) VALUES(:task,:datetime)';
            $query = $connect->prepare($insertQuery);
            $query->execute(['task' => $this->task, 'datetime' => $this->datetime]);

            self::unsetConnect();
            return true;
        } else return false;
    }

    public static function getAll(): array
    {
        self::connect();
        $connect = self::getConnection();

        $tasks = array();

        // получаем наши таски
        foreach ($connect->query('SELECT * from tasks ORDER BY id DESC') as $row) {
            $task = new Task(
                (string)$row['task'],
                (string)$row['datetime'],
                (int)$row['id']
            );

            $tasks[] = $task;
        }

        self::unsetConnect();
        return $tasks;
    }

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        return self::$connection;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDatetime(): string
    {
        return $this->datetime;
    }

    /**
     * @return string
     */
    public function getTask(): string
    {
        return $this->task;
    }

}