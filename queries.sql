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


CREATE TABLE categories (
                          id	    BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          title	VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE posts (
                     id			BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     user_id		BIGINT NOT NULL,
                     date_create DATETIME NOT NULL,
                     category_id	TEXT NOT NULL,
                     title		VARCHAR(255) NOT NULL,
                     is_done VARCHAR(1),
                     FOREIGN KEY(user_id) REFERENCES users(id)

);


INSERT INTO categories(title)
VALUES ('Входящие'),
       ('Учеба'),
       ('Работа'),
       ('Домашние дела'),
       ('Авто');
INSERT INTO users( nickname, email, password)
VALUES ('Andrew', 'my@mail.ru', '$2y$10$azTPD8NrWOdSm5GIrE5J/OE9Usc5JB4rq4CpR4xYv7Yc2Yb01ODXW'),
('Danil', 'denbach@mail.ru','123bach'),
('Oli','anonymus@mail.ru','olyaSyperstar');

INSERT INTO posts(user_id, title,date_create,category_id,is_done)
VALUES (1,'Собеседование в IT компании', '01.12.2019','Работа','false'),
       (2,'Выполнить тестовое задание', '25.12.2019','Работа','false'),
       (3,'Сделать задание первогораздела', '21.12.2019','Учеба','true'),
       (1,'Встреча с другом', '22.12.2019','Входящие','false'),
       (2,'Купить корм для кота', 'null','Домашние дела','false'),
       (3,'Заказать пиццу', 'null','Домашние дела','false');

SELECT id,
      nickname,
      email,
      password
FROM users;


SELECT id,
       title
FROM categories;


SELECT id,
       user_id,
       date_create,
       category_id,
       title,
       is_done
FROM posts;
