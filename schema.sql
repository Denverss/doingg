CREATE DATABASE blog120
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_0900_ai_ci;

USE blog120;

CREATE TABLE users (
                     id	    BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     name	    VARCHAR(255) NOT NULL,
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
                     img_url		VARCHAR(255) NOT NULL,
                     description  VARCHAR(4096) NOT NULL,
                     FOREIGN KEY(user_id) REFERENCES users(id),
                     FOREIGN KEY(category_id) REFERENCES categories(id)
);

CREATE TABLE comments (
                        id			BIGINT AUTO_INCREMENT PRIMARY KEY,
                        user_id		BIGINT NOT NULL,
                        post_id		BIGINT NOT NULL,
                        date_create	DATETIME NOT NULL,
                        message  		TEXT NOT NULL,
                        FOREIGN KEY(user_id) REFERENCES users(id),
                        FOREIGN KEY(post_id) REFERENCES posts(id)
);

INSERT INTO categories(title)
VALUES ('Путешествия'),
       ('наука и технологии'),
       ('Лайфхаки'),
       ('Мотивация'),
       ('Переводы песен'),
       ('Фильмы и сериалы');

INSERT INTO users( name, email, password)
VALUES ('Andrew', 'my@mail.ru', '$2y$10$azTPD8NrWOdSm5GIrE5J/OE9Usc5JB4rq4CpR4xYv7Yc2Yb01ODXW');

INSERT INTO posts(user_id, category_id, title, img_url, description)
VALUES (1, 1, 'Опасные жесты в разных странах', 'img/1.jpg',''),
       (1, 2, 'IT словарь и популярные компьютерные термины', 'img/2.jpg',''),
       (1, 3, 'Лайфхаки для запоминания новых английских слов', 'img/3.jpg',''),
       (1, 4, 'Со знанием английского доступен весь мир!', 'img/4.jpg',''),
       (1, 5, 'Текст и перевод песни F.R.I.E.N.D.S.', 'img/5.jpg',''),
       (1, 6, 'Ведьмак: сравнение книг, игр и сериала', 'img/6.jpg','');
