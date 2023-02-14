-- instalar o banco de dados para funcionar o site

CREATE DATABASE IF NOT EXISTS share;

USE share;

-- criação das tabelas:

CREATE TABLE IF NOT EXISTS user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    password CHAR(255) NOT NULL,
    nome_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    reputacao INT(11),
    numero_telefone VARCHAR(30) NOT NULL,
    PRIMARY KEY (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS genero (
    id_genero INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_genero)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS livro (
    id_livro INT(11) NOT NULL AUTO_INCREMENT,
    id_dono INT(11) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    img_path VARCHAR(255) NOT NULL,
    genero INT(11) NOT NULL,
    PRIMARY KEY (id_livro),
    FOREIGN KEY (id_dono) REFERENCES user(id_user),
    FOREIGN KEY (genero) REFERENCES genero(id_genero)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS troca (
    id_troca INT(11) NOT NULL AUTO_INCREMENT,
    id_user1 INT(11) NOT NULL,
    id_item_user1 INT(11) NOT NULL,
    id_user2 INT(11) NOT NULL,
    id_item_user2 INT(11) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_troca),
    FOREIGN KEY (id_user1) REFERENCES user(id_user),
    FOREIGN KEY (id_user2) REFERENCES user(id_user),
    FOREIGN KEY (id_item_user1) REFERENCES livro(id_livro),
    FOREIGN KEY (id_item_user2) REFERENCES livro(id_livro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS notificacao(
  id_notificacao INT(11) NOT NULL AUTO_INCREMENT,
  id_recebedor INT(11) NOT NULL,
  content VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_notificacao),
  FOREIGN KEY (id_recebedor) REFERENCES user(id_user)
);

-- generos para os livros (podendo adicionar muito mais):
INSERT INTO genero (nome) VALUES 
('Ação'),
('Aventura'),
('Comédia'),
('Drama'),
('Ficção Científica'),
('Romance'),
('Terror');

