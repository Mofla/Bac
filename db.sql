CREATE TABLE `users`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  firstname VARCHAR(60),
  lastname VARCHAR(80),
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  picture_url VARCHAR(255) DEFAULT 'default.jpg',
  role_id INT NOT NULL DEFAULT '2',
  is_active TINYINT DEFAULT 0,
  is_banned TINYINT DEFAULT 0,
  created DATETIME,
  modified DATETIME
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `roles`
(
  id INT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  description TEXT DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `articles`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  content TEXT NOT NULL,
  picture_url VARCHAR(255) DEFAULT 'default.jpg',
  state TINYINT NOT NULL DEFAULT 0,
  user_id INT NOT NULL,
  tag_id INT NOT NULL,
  created DATETIME,
  modified DATETIME
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `comments`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  content TEXT NOT NULL,
  user_id INT NOT NULL,
  created DATETIME,
  modified DATETIME
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `tags`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `article_comments`
(
  article_id INT NOT NULL,
  comment_id INT NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE users
ADD CONSTRAINT fk_role_id FOREIGN KEY(role_id) REFERENCES roles(id);

ALTER TABLE articles
ADD CONSTRAINT fk_tag_id FOREIGN KEY(tag_id) REFERENCES tags(id);

ALTER TABLE articles
ADD CONSTRAINT fk_art_user_id FOREIGN KEY(user_id) REFERENCES users(id);

ALTER TABLE comments
ADD CONSTRAINT fk_user_id FOREIGN KEY(user_id) REFERENCES users(id);

ALTER TABLE article_comments
ADD CONSTRAINT fk_article_id FOREIGN KEY(article_id) REFERENCES articles(id);

ALTER TABLE article_comments
ADD CONSTRAINT fk_comment_id FOREIGN KEY(comment_id) REFERENCES comments(id);

INSERT INTO roles (id, name, description) VALUES (1,'Administrateur','Possède tous les droits.');
INSERT INTO roles (id, name, description) VALUES (2,'Utilisateur','Peut voir les articles et poster des commentaires.');

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `picture_url`, `role_id`, `is_active`, `is_banned`, `created`, `modified`) VALUES
(1, 'admin', 'Billy', 'Peltzer', '$2y$10$/YT22OQPog3K1TQYwX1H7.XV3dZ.dHNfj0x5nlxYwxsUJDFjgXor2', 'admin@admin.fr', 'default.jpg', 1, 1, 0, '2016-11-10 09:20:02', '2016-11-10 09:20:02'),
(2, 'Mofla', 'Florent', 'Maillard', '$2y$10$XPrn/e.iC81qoHLOjYt7.O5We69R4j5/lvI7y0uTeI48mXqgH3zNO', 'florent.maillard.pro@gmail.com', '80787264001478788478.jpeg', 2, 1, '2016-11-10 14:17:35', '2016-11-10 15:20:15', '2016-11-10 15:20:15');

INSERT INTO tags (id, name) VALUES (1,'Cinéma');
INSERT INTO tags (id, name) VALUES (2,'Littérature');
INSERT INTO tags (id, name) VALUES (3,'Culture');
INSERT INTO tags (id, name) VALUES (4,'Code');
INSERT INTO tags (id, name) VALUES (5,'Jeux Vidéo');
INSERT INTO tags (id, name) VALUES (6,'Blabla');