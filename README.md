# ToDo PHP
## Небольшое предисловие
Я хотел убить сразу двух зайцев, 
поэтому в этой лабе ещё используется паттерн ActiveRecord, 
т.е. выполнено сразу две лабы. Следующая лабораторная 
будет основана на лабораторной с ToDo.

## Задание
### MySqCoTwi
Реализовать простое приложение PHP с 
использованием шаблонизатора twig и 
организации работы с базой данных MySQL с помощью PDO.
### ActiveRecord
Реализовать паттерн ActiveRecord над любой из таблиц.

Обязательные методы:
- save()
- remove()
- getById(id)
- all()
- getByField(fieldValue)
## Описание
### Что вообще произошло?
**Стек:**
composer + twig + mysql + pdo

В дополнение к основному стеку, использовал *phpdotenv*

В **/src** лежат классы, 
необходимые для реализации паттерна ActiveRecord.

В **/public** лежит *index.php* с рендерингом 
страницы *index.html.twig* и php файлы для работы задачами

### Что там на сервере?

Установка mysql
```
apt install mysql-server
mysqld -V
sudo service mysql start
sudo apt install php-pdo_mysql
```
**Работа с mysql**  
Создаём юзера
```mysql
sudo mysql -uroot
CREATE USER 'ToDoUser'@'194.67.74.23' IDENTIFIED BY 'ToDoPassword';
```

Выдаём права  
// это права, стоит ещё почитать какие права есть
```mysql
GRANT SELECT, INSERT, UPDATE, DELETE ON `ToDo`.* TO `ToDoUser`@`194.67.74.23`;

FLUSH PRIVILEGES;
```
Проверяем создался ли пользователь
```
sudo mysql -u ToDoUser -p
```
Наполняем нашу бд
```mysql
create database ToDo;
use ToDo;
show tables;
create table tasks (id INT AUTO_INCREMENT, task VARCHAR(255), PRIMARY KEY(id));
insert into tasks(task) values ("Сделать ToDoPHP"), ("Обработать запрос к БД");

select * from tasks;
```

Забыли добавить колонку с дедлайном, ну ничего страшного
```mysql
alter table tasks add column datetime datetime;
```
Наполнялись колонки так
```mysql
update tasks set `datetime`='2022-05-10 19:59:00' where id=2;
```

Конфиг файла default такой же, как и в прошлой лабе