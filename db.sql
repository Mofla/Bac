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
  article_id INT NOT NULL,
  user_id INT NOT NULL,
  created DATETIME,
  modified DATETIME
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `likes`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  comment_id INT NOT NULL,
  user_id INT NOT NULL,
  state TINYINT(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `tags`
(
  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE users
ADD CONSTRAINT fk_role_id FOREIGN KEY(role_id) REFERENCES roles(id);

ALTER TABLE articles
ADD CONSTRAINT fk_tag_id FOREIGN KEY(tag_id) REFERENCES tags(id);

ALTER TABLE articles
ADD CONSTRAINT fk_art_user_id FOREIGN KEY(user_id) REFERENCES users(id);

ALTER TABLE comments
ADD CONSTRAINT fk_user_id FOREIGN KEY(user_id) REFERENCES users(id);

ALTER TABLE comments
ADD CONSTRAINT fk_article_id FOREIGN KEY (article_id) REFERENCES articles(id);

ALTER TABLE likes
ADD CONSTRAINT fk_like_comment_id FOREIGN KEY (comment_id) REFERENCES comments(id);

ALTER TABLE likes
ADD CONSTRAINT fk_like_user_id FOREIGN KEY (user_id) REFERENCES users(id);

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

INSERT INTO `articles` (`id`, `name`, `content`, `state`, `user_id`, `tag_id`, `created`, `modified`) VALUES
(1, 'Les Gremlins', 'Randall Rand Peltzer (Hoyt Axton) est un inventeur farfelu aux créations des plus douteuses. De la ville fictive de Kingston Falls, il se rend dans le quartier de Chinatown à New York, pour tenter de vendre ses inventions et dénicher un cadeau de Noël original pour son fils Billy (Zach Galligan). Un jeune Chinois l''emmène au magasin de son grand-père, M. Wing. Rand, faute d''arriver à placer une de ses inventions comme la « salle de bain de poche », se prend d''intérêt pour une petite créature à fourrure, un Mogwaï (qui en chinois se traduit littéralement par « esprit malin »). Mais M. Wing (Keye Luke) refuse catégoriquement de vendre le Mogwaï malgré l''offre de 200 dollars de Rand. Selon lui, prendre en charge le petit animal entraîne de trop lourdes responsabilités pour son acquéreur.\r\n\r\nFinalement, le jeune Chinois se laisse convaincre par Rand, et il accepte de lui vendre le Mogwaï à l''insu de son grand-père. Mais il insiste sur certaines précautions à respecter impérativement : ne pas exposer l''animal à la lumière — et plus spécialement à celle du soleil qui le tuerait, ne pas le mouiller, et ne jamais lui donner à manger après minuit.\r\n\r\nRand baptise la créature Gizmo et la ramène chez lui pour son fils. Billy est un jeune homme qui travaille dans une banque afin d''aider ses parents, avec qui il vit toujours. Il a un chien nommé Barney, dont les dégâts les rendent cible, lui et Billy, d''un harcèlement permanent de Ruby Deagle (Polly Holliday), une femme acariâtre à l''influence et au pouvoir financier certains. Billy s''intéresse aussi à Kate Beringer (Phoebe Cates), une collègue de travail qui arrondit ses fins de mois grâce à un job de serveuse le soir dans un bar, et qui ne peut que constater amèrement la misère dont est victime sa ville, à cause des pratiques financières de Mme Deagle.\r\n\r\nBilly reçoit Gizmo un peu avant Noël et est rapidement fasciné par son intelligence, sa faculté d''apprentissage et ses talents de chanteur. Gizmo se révèle être un compagnon très doux et très affectueux. Malheureusement, un ami de Billy, Pete Fountaine (Corey Feldman), renverse accidentellement de l''eau sur Gizmo. Celui-ci est rapidement pris de convulsions visiblement douloureuses et, à la grande surprise de Billy, il se multiplie, donnant naissance à cinq nouveaux Mogwaïs. Ceux-ci semblent beaucoup plus agressifs que Gizmo, et être dirigés par l''un d''entre eux qui a une mèche blanche sur la tête (Le Rayé). Au matin, Billy emmène un des nouveau-nés à un professeur de sciences, Roy Hanson (Glynn Turman). À l''aide d''une simple goutte d''eau, Billy clone le Mogwaï sous les yeux étonnés de Roy, qui souhaite faire quelques tests complémentaires en gardant l''un des deux. Billy repart avec l''autre, tandis que Hanson provoque un peu plus l''agressivité de son Mogwaï lorsqu''il lui enfonce une seringue pour lui faire un prélèvement de sang. Négligeant les recommandations de base à cause de la fatigue due à l''heure tardive, Roy quitte le laboratoire en laissant malencontreusement son sandwich à portée de main du Mogwaï en cage, qui le dérobe et le consomme après minuit. Le même soir, les cinq nouveaux Mogwaïs bernent Billy en débranchant son réveil, puis réclament avec insistance de la nourriture. Trompé par l''heure qui est fausse, et croyant leur donner à manger avant minuit, il leur apporte du poulet, que tous dévorent ardemment… excepté Gizmo, qui reste suffisamment sage pour refuser.\r\n\r\nAu matin, tous les Mogwaïs - excepté Gizmo - se sont transformés en cocons visqueux, à l''intérieur desquels ils se métamorphosent. Alors que Billy est à la banque, tous les cocons, y compris celui qui s''est formé au laboratoire de Roy Hanson, éclosent et donnent naissance à des « Gremlins », des créatures terrifiantes aux grandes oreilles, aux dents acérées, et à la peau de reptile, qui n''ont plus rien à voir avec les adorables peluches vivantes qu''étaient les mogwaïs. Billy se rend à l''école pour voir Roy, mais retrouve son corps sans vie, près du Gremlin qui l''a tué. Billy, comprenant alors le processus de métamorphose qui s''est opéré, est attaqué par la créature, et tente de prévenir sa mère (Frances Lee McCain) du danger qu''elle court. Elle est seule à la maison avec les cinq autres Gremlins, et se bat avec eux, essayant de se défendre avec ses ustensiles de cuisine. Elle parvient à en tuer trois : le premier est haché dans son mixer, le second poignardé, le troisième explose dans son micro-ondes, et alors qu''elle est en train de se faire étrangler par un quatrième, Billy arrive, décapite le monstre et sauve sa mère. Le seul Gremlin survivant, celui qui a la crête de punk blanche (le chef, Le Rayé), arrive à s''échapper. Poursuivi par Billy jusqu''au YMCA local, il parvient à plonger dans la piscine municipale, causant une multiplication phénoménale. Billy réalise ce qui se passe et qu''il ne pourra pas lutter, et prend la fuite. La piscine est envahie par un écran de fumée et des rires sadiques…\r\n\r\nBilly emmène Gizmo à la taverne de Dorry pour retrouver Kate, qui est en service cette nuit-là. Les Gremlins ont envahi la taverne, et de façon très vulgaire, forcent Kate à les servir. Elle découvre qu''ils ne supportent pas la lumière lorsqu''elle allume une cigarette pour l''un d''entre eux. Elle parvient à s''échapper en utilisant le flash d''un appareil photo comme arme, et retrouve Billy. Le couple se réfugie dans la banque, alors que les Gremlins sèment la panique dans Kingston Falls. Ces derniers tuent Mme Deagle en la précipitant par une fenêtre et lancent un chasse neige contre la maison du couple Futterman (bien qu''ils soient laissés pour morts, ils ont survécu). Quand Billy, Kate et Gizmo émergent, les Gremlins sont partis. Ils se sont tous réfugiés au cinéma de la ville, où ils regardent Blanche-Neige et les Sept Nains. Billy et Kate parviennent à les enfermer et à faire sauter le cinéma. Tous les Gremlins brûlent, sauf Le Rayé, qui avait quitté les lieux juste avant pour aller manger dans une confiserie car il n''y avait plus de pop-corn.\r\n\r\nBilly poursuit Le Rayé jusqu''au centre commercial. À la recherche d''un point d''eau, Le Rayé parvient à trouver une petite fontaine où il va pouvoir se multiplier à nouveau et venger ses compagnons morts dans le cinéma. Mais le jour est en train de se lever : alors que Le Rayé entame sa multiplication, Gizmo qui s''est échappé réussit à ouvrir une fenêtre, exposant Le Rayé à la lumière du jour, qui le consume.\r\n\r\nM. Wing retrouve la ville qui a été le théâtre des ravages des Gremlins, et donc la famille Peltzer. Il reprend Gizmo pour éviter de nouveaux troubles, prétextant très moralement que la société occidentale n''est pas prête à accueillir un Mogwaï et que Billy sera prêt, un jour.', 1, 1, 1, '2016-11-10 13:16:16', '2016-11-10 13:16:16'),
(2, 'Gizmo', 'Gizmo est mogwaï trop mignon n''est-ce pas ?', 1, 1, 6, '2016-11-14 07:58:29', '2016-11-14 07:58:29');