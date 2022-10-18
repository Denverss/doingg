CREATE DATABASE Doing
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_0900_ai_ci;
USE Doing;
CREATE TABLE users (
                     id	    BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     nickname	    VARCHAR(255) NOT NULL,
                     email	VARCHAR(255) NOT NULL UNIQUE,
                     password VARCHAR(255) NOT NULL
);


CREATE TABLE projects (
                          id	    BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          title	VARCHAR(255) NOT NULL UNIQUE


);

CREATE TABLE tasks (
                     id			BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     user_id		BIGINT NOT NULL,
                     date_create DATETIME NOT NULL,
                     project_id	BIGINT NOT NULL,
                     title		VARCHAR(255) NOT NULL,
                     file  VARCHAR(255) NOT NULL,
                     is_done VARCHAR(1) ,
                     FOREIGN KEY(user_id) REFERENCES users(id),
                      FOREIGN KEY(project_id) REFERENCES  projects(id)

);


INSERT INTO projects(title)
VALUES ('Входящие'),
       ('Учеба'),
       ('Работа'),
       ('Домашние дела'),
       ('Авто');
INSERT INTO users(id, nickname, email, password)
VALUES (1,'Andrew', 'my@mail.ru', '$2y$10$azTPD8NrWOdSm5GIrE5J/OE9Usc5JB4rq4CpR4xYv7Yc2Yb01ODXW'),
(2,'Danil', 'denbach@mail.ru','123bach'),
(3,'Oli','anonymus@mail.ru','olyaSyperstar');

INSERT INTO tasks(user_id, title,date_create,project_id,is_done, file)
VALUES (1,'Собеседование в IT компании', '01.12.2019',3,'0','Link'),
       (2,'Выполнить тестовое задание', '25.12.2019',3,'0','File'),
       (3,'Сделать задание первого раздела', '21.12.2019',2,'1','File'),
       (1,'Встреча с другом', '22.12.2019',1,'0','File'),
       (2,'Купить корм для кота', '20.10.2022',4,'0','File'),
       (3,'Заказать пиццу', '15.10.2022',4,'0','Link');

SELECT id,
      nickname,
      email,
      password
FROM users;


SELECT
       title
FROM projects;


SELECT
       title
FROM tasks;
/**получить список из всех проектов для одного пользователя;*/
SELECT * FROM tasks WHERE user_id =1;
/**получить список из всех задач для одного проекта;*/
SELECT * FROM tasks WHERE project_id=3;
/**пометить задачу как выполненную;*/
UPDATE tasks
SET is_done='1'
WHERE user_id=1;
/** обновить название задачи по её идентификатору.*/
UPDATE tasks
SET title='Разговоры о важном'
WHERE id=1;
