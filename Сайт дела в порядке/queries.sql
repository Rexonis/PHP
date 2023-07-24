/*получение данных из таблицы пользователей*/
INSERT INTO Users (id, email, users_name, users_password) VALUES
(1001, '', '', ''),
(1002, '', '', ''),
(1003, '', '', '');

/*получение данных из таблицы проектов*/
INSERT INTO Projects (id, name_projects, users_id) VALUES
(2001,'Входящие сообщения', 1002),
(2002, 'Учеба', 1003),
(2003, 'Работа', 1001),
(2004, 'Домашние дела', 1001),
(2005, 'Авто', 1002);

/*получение данных из таблицы задач*/
INSERT INTO Tasks (id, status_tasks, name_tasks, random_file, projects_id, end_time) VALUES
(3001, false, 'Собеседование в IT компании', 'C:\files\file', 2001, "2019-12-01"),
(3002, false, 'Выполнить тестовое задание', 'C:\files\file', 2001, "2019-12-25"),
(3003, true, 'Сделать задание первого раздела', 'C:\files\file', 2002, "2019-12-21"),
(3004, false, 'Встреча с другом', 'C:\files\file', 2002, "2019-12-22"),
(3005, false, 'Купить корм для кота', 'C:\files\file', 2002, NULL),
(3006, false, 'Заказать пиццу', 'C:\files\file', 2002, NULL);

/*получение списка проектов дял 1 пользователя*/
SELECT users_id, name_projects FROM Projects WHERE users_id = 1001;

/*получение списка задач для 1 проекта*/
SELECT projects_id, name_tasks FROM Tasks WHERE projects_id = 2001;

/*помечание задачи как выполненая*/
UPDATE Tasks SET status_tasks = true WHERE id = 3002;

/*обновление названия задачи*/
UPDATE Tasks SET name_tasks = 'Выполнить доброе дело' WHERE id = 3002;

/*получить количество задач для каждого проекта*/
SELECT COUNT(Tasks.id) as count_tasks, projects_id, name_projects FROM Tasks RIGHT JOIN Projects ON Projects.id = Tasks.projects_id GROUP BY projects_id, name_projects;

/*новый пользователь*/
INSERT INTO Users SET id = 1004, email = '1234@mail.ru', users_name = '', users_password = '12344321';

/*новые проекты нового пользователя*/
INSERT INTO Projects (id, name_projects, users_id) VALUES
(2006,'Домашние дела', 1004),
(2007, 'Учеба', 1004),
(2008, 'Работа', 1004);

/*новые задачи для нового пользователя*/
INSERT INTO Tasks (id, status_tasks, name_tasks, random_file, projects_id, end_time) VALUES
(3007, false, 'Сделать отчет', 'C:\const\file', 2006, "2023-02-12"),
(3008, false, 'Сделать презентацию', 'C:\const\file', 2007, "2023-01-01"),
(3009, false, 'Разобрать материал по лекции', 'C:\const\file', 2007, "2023-09-09"),
(3010, true, 'Сделать уборку в комнате', 'C:\const\file', 2008, "2023-06-23"),
(3011, false, 'Сделать вкусный завтрак', 'C:\const\file', 2006, "2023-02-03");

/*получение всех задач текущего пользователя*/
SELECT name_tasks, end_time, name_projects, status_tasks FROM Projects LEFT JOIN Tasks ON Projects.id = Tasks.projects_id WHERE users_id = 1004;

/*получение списка проектов и количества задач у текущего пользователя*/
SELECT name_projects, COUNT(name_tasks) FROM Projects RIGHT JOIN Tasks ON Projects.id = Tasks.projects_id WHERE Projects.Users_id = 1004 GROUP BY name_projects;
