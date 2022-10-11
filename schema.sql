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
                     category_id	BIGINT NOT NULL,
                     title		VARCHAR(255) NOT NULL,
                     done
                     FOREIGN KEY(user_id) REFERENCES users(id),
                     FOREIGN KEY(category_id) REFERENCES categories(id)
);


INSERT INTO categories(title)
VALUES ('Входящие'),
  ('Учеба'),
  ('Работа'),
  ('Домашние дела'),
  ('Авто');
INSERT INTO users( nickname, email, password)
VALUES ('Andrew', 'my@mail.ru', '$2y$10$azTPD8NrWOdSm5GIrE5J/OE9Usc5JB4rq4CpR4xYv7Yc2Yb01ODXW');

INSERT INTO posts(user_id, title,category_id,done)
VALUES ("Собеседование в IT компании", "01.12.2019","Работа","false"),
       ("Выполнить тестовое задание", "25.12.2019","Работа","false"),
       ("Сделать задание первогораздела", "21.12.2019","Учеба","true"),
       ("Встреча с другом", "22.12.2019","Входящие","false"),
       ("Купить корм для кота", "null","Домашние дела","false"),
       ("Заказать пиццу", "null","Домашние дела","false");
